<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use App\Http\Controllers\Administrator;
use App\Http\Controllers\Administrator\Buyer;
use App\Http\Controllers\Administrator\Agents;
use App\Http\Controllers\Administrator\Search;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Authentication
Route::post('/login', [Api\LoginController::class, 'login']); 
Route::post('/forgotPassword', [Api\PasswordController::class, 'resetcodesend']); // forgot password


// Sign Up
Route::controller(Api\SignUpController::class)->group(function () {
    Route::post('/signup1', 'signup');
    Route::post('/signup2', 'signup2');
    Route::post('/signup3', 'signup3');
});

//Agents Search Controller
Route::controller(Api\AgentsSearchController::class)->group(function () {
    Route::post('/searchAgentsList', 'agentslist'); // find agent
    Route::Post('/agentsDetails', 'agentsdetails');  // connected = 1 , myjobs = 2
    Route::post('/searchAgentsDetails', 'agentsdetails');
    Route::post('/getPendingInvoices', 'getPendingInvoices'); // Pending invoices
    Route::post('/addclosingdate', 'addclosingdate'); // add closing date 
});

//Bookmark Controller
Route::controller(Api\BookmarkController::class)->group(function () {
    Route::get('/bookmarks', 'GetBookmarkListByDashbord');
    Route::post('/Bookmark', 'create');
    Route::post('/deleteBookmark', 'delete');
    Route::post('/getBookmarked', 'GetBookmarkedList');
    Route::post('/bookmark/data/insert', 'create'); //Bookmark 
});

// Buyer Search Controller
Route::controller(Api\BuyerSearchController::class)->group(function () {
    Route::get('/searchPosts', 'postlist');
    Route::any('/post', 'index');
    Route::post('/switchuser', 'switchuser');
});

//Compare Controller
Route::controller(Api\CompareController::class)->group(function () {
    Route::any('/compare', 'index');
    Route::post('/removeCompare', 'delete');
    Route::post('/compare/insert', 'create');
    Route::post('/compared', 'ComparedDataGetByPost');
    Route::get('/compare/delete/{compare_id}/{user_id}', 'delete');
});

// Dashboard Controller
Route::controller(Api\DashboardController::class)->group(function () {
    Route::post('/dashboard', 'selectedPosts');
    Route::get('/buyerPosts', 'BuyerPosts');
    Route::get('/getPostDetails', 'PostDetailsForBuyer');
    // Route::post('/newpost', 'store'); // JkWorkz. Duplicate of /profile/buyer/newpost. Commented to see if it's being used anywhere
    Route::get('/appliedagents', 'AppliedAgents'); //applied post buyer selecte agent for post
});

//Messaging/Chat Controller
Route::controller(Api\MessagingChatController::class)->group(function () {

    Route::prefix('/messages')->group(function () {
        Route::get('/', 'index'); // Chat messages

        Route::prefix('/list')->group(function () {
            Route::get('/conversation', 'ConversationList'); // List of recipients
            Route::get('/conversation/messages', 'ConversationMessagesList'); // List of messages sent to a recipient
            Route::get('/sent', 'SentMessage');
            Route::get('/unread', 'UnreadMessage');
        });

        Route::post('/new', 'InsertNewMessage');
        Route::post('/create/conversation', 'create_conversation');
        Route::post('/set-as/opened', 'readupdate');
    });

    // Route::get('/NewConversation/{post_id}/{receiver_id}/{receiver_role_id}/{sender_id}', 'createconversation');
    // Route::post('/insert/new/messages', 'InsertNewMessage');
    // Route::post('/update/read/messages', 'readupdate');


    /* Get the notifications list*/
    Route::get('/notifications/{limit}', 'getnotifications');
    Route::get('/notifications/read/{id}', 'update');
});

// Notes Controller
Route::controller(Api\NotesController::class)->group(function () {
    Route::post('/deleteNotes', 'delete'); // notess 
    Route::post('/updateNote', 'update');
    Route::post('/addNotes', 'create');
    Route::post('/notes', 'GetnotesListByDashbord');
});

//Profile Controller
Route::controller(Api\ProfileController::class)->group(function () {
    Route::prefix('/profile')->group(function () {
        // Jkworkz
        Route::get('/delete', 'delete_page');
        Route::post('/delete', 'delete_profile');
        
        Route::post('/changepassword', 'changepassword');
    
        /*Profile*/
        Route::get('/buyer ', 'buyer_api');
        Route::get('/agent', 'agent');
    
        Route::post('/buyer/editfields', 'editfields');
        
        Route::post('/editSkills', 'editSkills');
        Route::get('/getAllSkills', 'getAllSkills');
        Route::post('/getUserSkills', 'getUserSkills');
        Route::post('/editFields', 'editFields');
        Route::post('/editbuyerprofile', 'editbuyerprofile');
        Route::post('/editagentprofile', 'editagentprofile');
        Route::post('/editagentprofessionalprofile', 'editagentprofessionalprofile');
        Route::get('/resume', 'resume');
    });

    // Route::get('/get_token', 'get_token');
    // Route::post('/send_token', 'send_token');

    //and profile picture
    Route::post('/profilePicture', 'editprofilepic');
    Route::post('/getuserdetails', 'getUserDetails');

    //security 
    Route::get('/getsecurtyquestion', 'getsecurityquestions');
    Route::post('/securtyquestion', 'securtyquestion');
    Route::get('/security/buyer', 'buyersettings');

    /*edit agent profile */
    Route::Post('/personalbio', 'resume');
    Route::Post('/editpersonalbio', 'editFieldsbio');
    Route::Post('/getpersonalbio', 'showbio');
    Route::Post('/profilesettings', 'profilesettings');
    // Route::post('/editagentprofile', 'editagentprofile');

    Route::get('/agentPosts', 'AppliedPostListGetForAgents');
    Route::post('/profile/agent/sellDetails', 'updateSellDetials')->name('update_sell');
    Route::get('/applied/post/{status}', 'AppliedPostForAgents')->name("appliedposts");
    Route::post('contactSend', 'contactSend');
    Route::post('/paymentagents', 'paymentagents');
    Route::post('/saveCard', 'saveCard');

    Route::any('/franchise', 'franchise');
});

//Question Answers Controller
Route::controller(Api\QuestionAnswersController::class)->group(function () {
    Route::post('/tests', 'show');

    /* asked question agent */
    Route::prefix('/questionanswer')->group(function () {
        Route::post('/show', 'show');
        Route::any('/updatequestion', 'update');
    });

    Route::prefix('/questiontoanswer')->group(function () {
        Route::any('/', 'questiontoanswer');
    
        Route::post('/updatesurvey', 'updatesurvey');
        Route::post('/deletesurvey', 'deletesurvey');
        Route::post('/removesurvayquestion', 'removeservaylistquestion');
    });

    Route::prefix('/question')->group(function () {
        Route::any('/get/only/user', 'getonlyusersquestion');
        Route::any('/getaskedquestion', 'getaskedquestion');
    });

    Route::any('/insertquestion', 'create');
});

// Rating Controller // sendratingforagentbybuyerseller
Route::post('/agent/rating', [Api\RatingController::class, 'agent_rating']); /*Rating */

// Shared Controller
Route::controller(Api\SharedController::class)->group(function () {
    Route::post('askedQuestions', 'getSharedQuestionAndAnswer');  /* asked question agent */
    Route::post('/getSharedProposals', 'getSharedProposals'); /*Shared*/
    Route::any('/askedquestion', 'create'); 
});

//State Controller
Route::controller(Api\StateController::class)->group(function () {
    Route::post('/state', 'states');
    Route::post('/sellOptions', 'whenDoYouWantToSell');
});

//Survey Controller
Route::get('/question/list/', [Api\SurveyController::class, 'buyersindex']); 

//Upload and Share Controller
Route::controller(Api\UploadAndShareController::class)->group(function () {
    Route::post('/documents', 'show');
    Route::post('/proposals/delete', 'delete');
    Route::post('/uploadandshare/delete/', 'delete');
    /* Files */
    Route::any('/getSharedFiles/{files}', 'getfileswithshared');
    Route::post('/uploadFileDemo', 'uploadFileDemo');
});

// Administrator\Agents\QuestionAnswers\QuestionAnswersController
Route::controller(Agents\QuestionAnswers\QuestionAnswersController::class)->group(function () {
    Route::post('/insertquestion', 'create');
    Route::post('/updatequestion', 'update');

    Route::prefix('/question')->group(function () {
        Route::get('/get/only/user', 'getonlyusersquestion');
        Route::get('/get', 'showSkill');
    });

    Route::any('/adminquestiontoanswer', 'questiontoanswer');
});

// Administrator\Buyer\ImportanceController
Route::get('/importance/get/{limit}/{id}/{roleid}', [Buyer\ImportanceController::class, 'getLimitedDataByAny']);

// Administrator\Buyer\PostController
Route::controller(Buyer\PostController::class)->group(function () {
    Route::post('/newpost', 'store');
    Route::prefix('/profile/buyer')->group(function () {
        Route::get('/post/get', 'getpostsingalByAny');
        Route::get('/post/get/{limit}', 'getDetailsByAny');
        Route::get('/post/details/{post_id}', 'PostDetailsForBuyer');
    });
});

// Administrator\NotificationController
Route::controller(Administrator\NotificationController::class)->group(function () {
    Route::get('/notification/get/{limit}', 'indextell');
    Route::get('/message/notification/get/{limit}', 'MessageNotificationtell');
});

// Administrator\PaymentController
Route::controller(Administrator\PaymentController::class)->group(function () {
    Route::post('/pay_pendinginvoices/invoice', 'pay_pendinginvoices_api');
    Route::post('/pending/pay/invoice', 'payitnow_api');
    Route::post('/postAgentPayment/invoice', 'postAgentPayment_api');
    Route::post('/downloadinvoice/invoice', 'downloadinvoice_api');
});

// Administrator\ProfileController
Route::controller(Administrator\ProfileController::class)->group(function () {
    Route::any('/get_state', 'state');
    Route::any('/get_city/{state_id}', 'city');
});

// Administrator\Search\AgentsSearchController
Route::any('/search/agents/list/{limit}', [Search\AgentsSearchController::class, 'agentslist']);

// Administrator\SurveyController
Route::get('/survey/get/{limit}/{id}/{roleid}', [Administrator\SurveyController::class, 'getLimitedDataByAny']);

// Administrator\UploadAndShareController
Route::prefix('/uploadshare')->controller(Administrator\UploadAndShareController::class)->group(function () {
    Route::get('/get/{limit}/{userid}/{roleid}', 'show');
    Route::post('/insert', 'store');
    Route::get('/delete/{id}', 'delete');
});

// Api\ProposalsController
Route::post('/proposals/store', [Api\ProposalsController::class, 'store']);
