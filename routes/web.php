<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrator;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Front;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
|
*/

/* ==================== Front\LanguageController ==================== */
/*Language Route*/

Route::any('/lang/{lg}', [Front\LangaugeController::class, 'index']);

Route::controller(Administrator\Admin\PopinController::class)->group(function () {
    Route::get('/show-popin', 'show_popin')->name('show-popin');
    Route::get('/view-popin', 'view_popin')->name('view-popin');
});

/* ==================== Front\HomeController ==================== */
Route::controller(Front\HomeController::class)->group(function () {

    /*Public Pages*/
    Route::get('/terms', 'terms');
    Route::get('/privacy', 'privacy');
    Route::get('/new-terms', 'newTerms');
    Route::get('/best-shoots', 'bestShoots');
    Route::get('/incredible-content', 'incredibleContent');
    Route::get('/aboutus', 'aboutus');
    Route::get('/advertise', 'showadvertise');
    Route::get('/agent', 'agent');
    Route::get('/sellers', 'sellers');
    Route::get('/buyers', 'buyers');
    Route::get('/contactus', 'contact');
    Route::post('/feedback', 'feedback')->name('feedback');
    Route::post('contactSend', 'contactSend')->name('contactSend');

    /*Front View Of Blog*/
    Route::prefix('blogs')->group(function () {
        Route::get('/', 'blogs');
        Route::get('/{id}/{title}', 'singleblogs');
        Route::get('/category/{id}/{title}', 'categoryblogs');
        Route::post('/comment', 'savecomment');
        /*=== Front view of Blog Eng ===*/
    });
});


Route::group(['middleware' => ['lang', 'guest']], function () {
    Route::controller(Front\HomeController::class)->group(function () {
        // Home 
        Route::get('/', 'index')->name('home');
        Route::get('/signup/{stype}/', 'index')->name('home');

        // Authentication 
        Route::get('/login', 'login_email_verify')->name('login');

        // Registration
        Route::post('/signup1', 'signup')->name('signup');
        Route::post('/signup2', 'signup2')->name('signup2');
        Route::post('/signup3', 'signup3')->name('signup3');

        /* Mobile */
        Route::prefix('mobile')->group(function () {
            Route::post('/signup1', 'signup');
            Route::post('/signup2', 'signup2');
            Route::post('/signup3', 'signup3');
        });

        Route::get('/sendsignupmail/', 'newUserMailSend')->name('sendsignupmail');

        // Password Reset
        Route::get('/password/reset', 'reset')->name('reset');
    });

    /* ==================== Auth\LoginController ==================== */
    Route::controller(Auth\LoginController::class)->group(function () {
        /*Authentication Routes...*/
        Route::post('/login', 'login');
        Route::post('/login_api', 'login_api');

        /* Mobile */
        Route::post('/mobile/login_api', 'login_api');

        /* Logout */
        Route::get('/logout', 'logout')->name('logout')->middleware(['auth', 'lang', 'sTime', 'check-user-activation'])->withoutMiddleware(['guest']);
    });

    /* ==================== Auth\ForgotPasswordController ==================== */
    Route::prefix('password')->controller(Auth\ForgotPasswordController::class)->group(function () {
        /*Password Reset Routes...*/
        Route::post('/resetcodesend', 'resetcodesend')->name('resetcodesend');
        Route::get('/resetcodesendbyadmin/{email}', 'resetcodesendbyadmin');
        Route::get('/code/{token}', 'resetPasswordForm')->name('resetpasswordform');
        Route::post('/resetpassword', 'resetPassword')->name('resetpassword');
    });
});


/* ==================== Administrator\DashboardController ==================== */
Route::get('/agentStatus', [Administrator\DashboardController::class, 'agentStatus']);

Route::controller(Administrator\DashboardController::class)->group(function () {
    Route::get('/agentStatus', 'agentStatus');

    /* Dashboard*/
    Route::get('/dashboard', 'index')->middleware(['auth', 'lang', 'sTime', 'check-user-activation'])->name('dashboard');
});


/* ==================== Administrator\ProfileController ==================== */
Route::controller(Administrator\ProfileController::class)->group(function () {

    Route::get('/downloadContract', 'contract');

    Route::middleware(['lang', 'guest'])->group(function () {
        Route::any('/get_state', 'state');
        Route::any('/get_city/{state_id}', 'city');
    });

    Route::prefix('profile')->middleware(['auth', 'lang', 'sTime', 'check-user-activation'])->group(function () {

        Route::get('/{name}/proposal', 'proposal');
        Route::get('/{name}/documents', 'documents');

        Route::prefix('agent')->group(function () {
            Route::get('/', 'agent');
            Route::get('/personal', 'resume');
            Route::post('/personal', 'resume');
            Route::get('/professional', 'resume')->name('profile.agent.prof_bio_page');
            Route::get('/questions', 'agentsquestions');
            Route::get('/tests', 'agentsquestions');
            Route::get('/settings', 'agentsettings');
            Route::get('/security', 'agentsettings');
            Route::get('/password', 'agentsettings');
            Route::post('/editfields', 'editfields');
            Route::post('/editprofilepic', 'editprofilepic');
            Route::post('/editAgentPersonalProfile', 'editagentprofile');
            Route::post('/sellDetails', 'updateSellDetials')->name('update_sell');
            // Route::post('/', 'editagentprofessionalprofile');
            Route::post('/editagentprofile', 'editagentprofessionalprofile');
            Route::post('/editagentprofessionalprofile', 'editagentprofessionalprofile');
        });

        Route::prefix('buyer')->group(function () {
            Route::get('/', 'buyer');
            Route::get('/questions', 'buyerquestions');
            Route::get('/tests', 'buyerquestions');
            Route::get('/settings', 'buyersettings');
            Route::get('/personal', 'buyersettings');
            Route::get('/security', 'buyersettings');
            Route::get('/password', 'buyersettings');
            Route::post('/editfields', 'editfields');
            Route::post('/editbuyerprofile', 'editbuyerprofile');
            Route::post('/updateposttitle', 'updateposttitle');
        });
    });

    /*Security Question*/
    Route::post('/securtyquestion/change', 'securtyquestion');

    /* Change Password*/
    Route::post('/password/changepassword', 'changepassword');

    /*State City Area Certifications  Specialization Franchise */
    Route::any('/state/get', 'state');

    Route::prefix('city')->group(function () {
        Route::any('/get', 'city');
        Route::any('/get/{state_id}', 'city');
    });

    Route::any('/area/get/', 'area');
    Route::any('/certifications/get/', 'certifications');
    Route::any('/specialization/get/', 'specialization');
    Route::any('/franchise/get/{id?}', 'franchise');

    /*Skilles*/
    Route::any('/skills/get', 'skills');

    /*Public Users Connection*/
    Route::prefix('users')->group(function () {
        Route::post('/public/connection', 'publicConnection');
        Route::get('/{id}/{roleid}', 'publicUserGet');
    });

    /*Applied Post And Agents */
    Route::get('/posts/applied', 'appliedPostForAgents')->name("applied_posts");

    Route::post('/searchbydate', 'appliedPostForAgentsByDate')->name("appliedpostsbydate");

    Route::get('/applied/post/list/get/{limit}/{userid}/{roleid}/{selected?}/{user_role_id?}', 'appliedPostListGetForAgents');

    /* Connected Jobs/Post For Agents*/
    Route::get('/agent/connected/post', 'connectedJobsForAgents');
});


/* ==================== Administrator\Search\AgentsSearchController ==================== */
Route::controller(Administrator\Search\AgentsSearchController::class)->group(function () {
    Route::get('/inputclosingdate', 'inputclosingdate');
    Route::post('/inputclosingdate', 'inputclosingdatestore');
    Route::get('/closingdatecronjob', 'closingdatecronjob');
});

/* ==================== Administrator\Agents\ProposalsController ==================== */
Route::middleware(['auth', 'lang', 'sTime', 'check-user-activation'])->group(function () {
    Route::controller(Administrator\Agents\ProposalsController::class)->group(function () {
        /* Agent proposale*/
        Route::prefix('agent/proposal')->group(function () {
            Route::post('/insert', 'store');
            Route::get('/get/{limit}/{userid}/{roleid}', 'show');
            Route::get('/get/ten/{limit}/{userid}/{roleid}', 'showten');
            Route::get('/delete/{id}', 'delete');
        });

        Route::any('/get/proposal/with/shared/{limit}', 'getproposalwithshared');
    });

    Route::controller(Administrator\Agents\AdvertiseController::class)->group(function () {
        Route::get('/agent-advertisement', 'agent_advertisement')->name('agent-advertisement');
        Route::get('/agent-advertisement-plans', 'agent_adds_plans')->name('agent-adds-plans');
        Route::post('/advertisement-payment-form', 'payment_form')->name('advertisement-payment-form');
        Route::get('/agent-stripe-payment', 'stripe_payment')->name('agent-stripe-payment');
        Route::get('/agent-add-advertisement', 'create_advrtismnt')->name('create-advrtismnt');
        Route::post('/store-advertisement', 'store_advrtismnt')->name('store-advrtismnt');
        Route::get('/agent-edit-advertisement/{id}', 'edit_advrtismnt')->name('edit-advrtismnt');
        Route::post('/update-advrtismnt', 'update_advrtismnt')->name('update-advrtismnt');
        Route::get('/advrtismnt-change-status/{id}', 'update_popin_status')->name('advrtismnt-change-status');
        Route::get('/delete-advrtismnt/{id}', 'delete_advrtismnt')->name('delete-advrtismnt');
        Route::get('/agent-points/{id}', 'agent_points')->name('agent-points');
        Route::get('/delete-points-history/{id}', 'delete_points_history')->name('delete-points-history');
    });


    /* ==================== Administrator\Buyer\PostController ==================== */
    Route::controller(Administrator\Buyer\PostController::class)->group(function () {
        Route::get('/add-new-feature', 'addfeature');
        Route::post('/addClosingDate', 'addClosingDate');
        Route::post('/validatepaymentamount', 'validatepaymentamount');
        // Route::post('/selldetails',  'selldetails'); // JkWorkz.. See if any page gives error

        /*buyer or seller posts*/
        Route::prefix('profile')->group(function () {
            /* Common Routes */
            Route::get('/seller/posts', 'index');
            Route::get('/seller/compareposts', 'ComparePost');
            Route::get('/seller/post/details/{post_id}', 'PostDetailsForBuyer')->name('seller-post-detail');
            Route::get('/seller/post/details/{post_id}/{compare}', 'PostDetailsForBuyer');
            Route::get('/seller/post/details/agents/get/few/{post_id}/{userid}/{roleid}', 'PostDetailsAgentsGetForBuyerlimitfive');
            Route::get('/seller/post/details/agents/get/{limit}/{post_id}/{userid}/{roleid}', 'PostDetailsAgentsGetForBuyer');

            Route::get('/buyer/posts', 'index');
            Route::get('/buyer/compareposts', 'ComparePost');
            Route::get('/buyer/post/details/{post_id}', 'PostDetailsForBuyer')->name('buyer-post-detail');;
            Route::get('/buyer/post/details/{post_id}/{compare}', 'PostDetailsForBuyer');
            Route::get('/buyer/post/details/agents/get/few/{post_id}/{userid}/{roleid}', 'PostDetailsAgentsGetForBuyerlimitfive');
            Route::get('/buyer/post/details/agents/get/{limit}/{post_id}/{userid}/{roleid}', 'PostDetailsAgentsGetForBuyer');

            /* Buyer Specific Routes */
            Route::any('/buyer/post/get/{limit?}', 'getDetailsByAny');
            Route::any('/buyer/post/get/selected/{limit}', 'getSelectedDetailsByAny');
            Route::post('/buyer/post/get', 'getpostsingalByAny');
            Route::post('/buyer/updateposttitle', 'updateposttitle');
            Route::post('/buyer/newpost', 'store');
        });

        /*applied post buyer selecte agent for post*/
        Route::post('/post/select-agent', 'SelectAgentForPost')->name('SelectAgentForPost');
        Route::get('/appliedagents/{post_id}/{agentid}', 'AppliedAgents');
    });



    /* ==================== Administrator\UploadAndShareController ==================== */
    Route::controller(Administrator\UploadAndShareController::class)->group(function () {
        /* A/B/S files upload and share*/
        Route::prefix('uploadshare')->group(function () {
            Route::post('/insert', 'store');
            Route::get('/get/{limit}/{userid}/{roleid}', 'show');
            Route::get('/get/ten/{limit}/{userid}/{roleid}', 'showten');
            Route::get('/delete/{id}', 'delete');
        });
        Route::any('/get/uploaded/files/with/shared/{limit}', 'getfileswithshared');
    });


    /* ==================== Administrator\Agents\QuestionAnswers\QuestionAnswersController ==================== */
    Route::controller(Administrator\Agents\QuestionAnswers\QuestionAnswersController::class)->group(function () {
        /*QuestionAnswers*/
        Route::prefix('question/get')->group(function () {
            Route::any('/', 'show');
            Route::any('/only/user', 'getonlyusersquestion');
        });
        Route::any('/updatequestion', 'update');
        Route::any('/insertquestion', 'create');
        Route::any('/questiontoanswer', 'questiontoanswer');
        Route::any('/allsubmitquestiontoanswer', 'allsubmitquestiontoanswer');
    });


    /* ==================== Administrator\Buyer\ImportanceController ==================== */
    Route::controller(Administrator\Buyer\ImportanceController::class)->group(function () {
        /* importance b/s */
        Route::prefix('importance')->group(function () {
            Route::any('/', 'update');
            Route::any('/list/', 'index');
            Route::get('/get/{limit}/{id}/{roleid}', 'getLimitedDataByAny');
            Route::get('/delete/{id}', 'delete');
            Route::post('/delete', 'removeimportancelistquestion');
        });
    });


    /* ==================== Administrator\SurveyController ==================== */
    Route::controller(Administrator\SurveyController::class)->group(function () {
        /*survey*/
        Route::prefix('survey')->group(function () {
            Route::any('/buyers/list/', 'buyersindex');
            Route::any('/agent/list/', 'agentsindex');
            Route::any('/', 'update');
            Route::get('/get/{limit}/{id}/{roleid}', 'getLimitedDataByAny');
            Route::get('/delete/{id}', 'delete');
            Route::post('/delete', 'removeservaylistquestion');
            Route::any('/loop/question/get', 'SurvayLoopQuestion');
        });
    });


    /* ==================== Administrator\Search\AgentsSearchController ==================== */
    Route::prefix('search/agents')->controller(Administrator\Search\AgentsSearchController::class)->group(function () {
        /*Search agents*/
        Route::any('/', 'index');
        Route::any('/list/{limit}', 'agentslist');
        Route::post('/details', 'addcomment')->name('comment.addcomment');
        Route::any('/details/{agent_id}', 'agentsdetails');
        Route::any('/details/{agent_id}/{post_id}', 'agentsdetails');
        Route::any('/details/{agent_id}/{post_id}/{notitype}', 'agentsdetails');
    });


    /* ==================== Administrator\Search\BuyerSearchController ==================== */
    Route::controller(Administrator\Search\BuyerSearchController::class)->group(function () {
        /*Search post*/
        Route::any('/post', 'index');
        Route::any('/postForAgents', 'postForAgents');
        Route::any('/switchuser', 'switchuser');
        Route::any('/search/post/list/{limit}', 'postlist');
        Route::any('/search/post/details/{id}/{notitype?}', 'postdetails')->name('post_details');
        Route::get('/search/buyer/details/{id}/{roleid}', 'buyerdetails');
    });


    /* ==================== Administrator\SharedController ==================== */
    Route::controller(Administrator\SharedController::class)->group(function () {
        /*Shared Data*/
        Route::prefix('shared')->group(function () {
            Route::post('/data/insert', 'create');
            Route::post('/data/delete', 'delete');
            Route::post('/question/answer/get', 'getSharedQuestionAndAnswer');
            Route::post('/upload/files/get', 'getSharedUploadAndFiles');
            Route::post('/proposals/get', 'getSharedProposals');
            Route::any('/proposals/with/connected/users/by/{proposal_id}/{userid}/{user_role}', 'GetSharedPropsalUsersAndConnectedUers');
            Route::any('/documents/with/connected/users/by/{docs_id}/{userid}/{user_role}', 'GetSharedDocumentUsersAndConnectedUers');
            Route::any('/question/with/connected/users/by/{question_id}/{share_user_type}/{userid}/{user_role}', 'GetSharedQuestionUsersAndConnectedUers');
        });
    });


    /* ==================== Administrator\Messages\MessagingChatController ==================== */
    Route::controller(Administrator\Messages\MessagingChatController::class)->group(function () {
        /*Messaging/ Chat*/
        Route::get('/messages/', 'index');
        // Route::get('/messages/{post_id}', 'index');
        Route::get('/messages/{post_id}/{receiver_id}/{receiver_role_id}', 'index');
        Route::get('/NewConversation/{post_id}/{receiver_id}/{receiver_role_id}', 'createconversation');
        Route::any('/insert/new/messages', 'InsertNewMessage');
        Route::any('/read/update/messages', 'readupdate');

        Route::prefix('messageslist/get')->group(function () {
            Route::any('/conversation/{limit}', 'ConversationList');
            Route::any('/conversation/messages/{limit}', 'ConversationMessagesList');
            Route::any('/sended/{limit}', 'SendedMessage');
            Route::any('/unread', 'UnreadMessage');
        });
    });

    // Messages POST / GET
    // Profile Structure

    /* ==================== Administrator\BookmarkController ==================== */
    Route::controller(Administrator\BookmarkController::class)->group(function () {
        /*bookmark*/
        Route::get('/{name}/bookmark/', 'index');

        Route::prefix('/bookmark/data')->group(function () {
            Route::post('/insert', 'create');
            Route::get('/delete/{id}', 'delete');
        });

        Route::prefix('/bookmarked')->group(function () {
            Route::get('/get/{id}/{role}/{bookmark_type}/{bookmark_item_id}/{bookmark_item_parent_id}', 'GetBookmarkedList');
            Route::get('/list/get/{limit}', 'GetBookmarkListByDashbord');
            Route::get('/delete/by/{id}', 'delete');
        });
    });


    /* ==================== Administrator\RatingController ==================== */
    Route::controller(Administrator\RatingController::class)->group(function () {
        /*Rating*/
        Route::prefix('rating')->group(function () {
            Route::post('/data/insert', 'create');
            Route::get('/data/delete/{id}', 'delete');
            Route::get('/get/{id}/{role}/{rating_type}/{rating_item_id}/{rating_item_parent_id}/{receiver_id}/{receiver_role}', 'GetRatingedList');
        });

        Route::post('/agent/rating', 'agent_rating')->name('agent_rating');

        /* Test */
        Route::get('/reviewofpost/{post_id}', 'reviewofpost');

        Route::get('agent-rating/{id}', 'get_agent_rating')->name('get-agent-rating');
        Route::post('store-agent-rating', 'store_agent_rating')->name('store-agent-rating');
        Route::get('delete-agent-rating/{id}', 'delete_agent_rating')->name('delete-agent-rating');
        Route::get('like-blog/{id}', 'like_blog')->name('like-blog');
        Route::get('dislike-blog/{id}', 'dislike_blog')->name('dislike-blog');
    });


    /* ==================== Administrator\NotesController ==================== */
    Route::controller(Administrator\NotesController::class)->group(function () {
        /*Notes*/
        Route::get('/{name}/notes/', 'index');
        Route::prefix('notes')->group(function () {
            Route::post('/data/insert', 'create');
            Route::post('/data/update/{id}', 'update');
            Route::get('/data/delete/{id}', 'delete');
            Route::get('/get/{id}/{role}/{notes_type}/{notes_item_id}/{notes_item_parent_id}/{receiver_id}/{receiver_role}', 'GetNotesedList');
            Route::get('/list/get/{limit}', 'GetnotesListByDashbord');
            Route::get('/delete/by/{id}', 'delete');
        });
    });


    /* ==================== Administrator\NotificationController ==================== */
    Route::controller(Administrator\NotificationController::class)->group(function () {
        /*notification*/
        Route::prefix('notification')->group(function () {
            Route::get('/get/{limit}', 'index');
            Route::get('/update/read/{id}', 'update');
            //Route::get('/update/read/{id}', 'update');
            Route::post('/update/read/by/receiver_id', 'UpdateByReceiver_id');
        });
        Route::get('/message/notification/get/{limit}', 'MessageNotification');
    });


    /* ==================== Administrator\Compare\CompareController ==================== */
    Route::controller(Administrator\Compare\CompareController::class)->group(function () {
        /*compare*/
        Route::prefix('compare')->group(function () {
            Route::any('/', 'index');
            Route::get('/list/{limit}/{userid}/{role}/{post_id}', 'show');
            Route::post('/insert', 'create');
            Route::get('/delete/{compare_id}/{user_id}', 'delete');
        });
        Route::get('/compared/data/get/{post_id}/{sender_id}/{sender_role}', 'ComparedDataGetByPost');
    });


    /* ==================== Administrator\PaymentController ==================== */
    Route::controller(Administrator\PaymentController::class)->group(function () {
        /*payment */
        Route::post('/paymentagents', 'paymentagents'); // JkWorkz
        // Route::get('/getPaymentByAny/{limit}/{userid}', 'getPaymentByAny'); // JkWorkz

        # advertise payment
        Route::get('/paymentpage/{package_id}', 'paymentpage');
        Route::post('/postPayment', 'postPayment');
        Route::get('/paymentStatus', 'paymentStatus');

        # commision payment
        // Route::get('/pendinginvoices', 'pendinginvoices')->name('pending_invoices_page');

        Route::any('/posts/invoice/pending', 'invoice_payment_page')->name('invoice_payment_page'); // JkWorkz
        Route::get('/posts/invoice/payment-success', 'payment_success')->name('payment_success');

         // JkWorkz | Delete it once all instances are moved to invoice_payment_page
        // Route::post('/pay_pendinginvoices', 'pay_pendinginvoices')->name('pay_pendinginvoices'); // Same Function, Same View
        // Route::get('/pending/pay/{id}', 'payitnow')->name('payitnow'); // Same Function, Same View

        Route::post('/postAgentPayment', 'postAgentPayment');
        Route::post('/downloadinvoice', 'downloadinvoice');
    });


    /* ==================== Administrator\BlogController ==================== */
    Route::controller(Administrator\BlogController::class)->group(function () {
        Route::prefix('buyer')->group(function () {
            Route::prefix('blog')->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'blogstore')->name('blog.addblog');
                Route::post('/update', 'singleBlogUpdate')->name('blog.update');
                Route::get('/{id}', 'delblog');
            });

            Route::get('/advertisement', 'advertisement');
            Route::get('/get/blog/{id}', 'getSingleBlog');
            Route::get('/get/single-blog/{id}', 'getSingleBlogview');
        });
        Route::post('add-blog-comment', 'add_blog_comment')->name('add-blog-comment');
    });


    /* ==================== Administrator\Agents\AdController ==================== */
    Route::controller(Administrator\Agents\AdController::class)->group(function () {
        Route::get('/manageads', 'manage');
        Route::any('/configureads/{ad_id?}', 'configureads');
        Route::get('/adclicks/{ad_id}', 'adclicks');

        # 11-07-2020
        Route::get('/advertiseinvoice/{ad_id}', 'advertiseinvoice');
    });


    /* ==================== Administrator\Agents\PostController ==================== */
    Route::controller(Administrator\Agents\PostController::class)->group(function () {
        /* Agent selected posts */
        Route::prefix('agent/selected/post')->group(function () {
            Route::get('/', 'agentSelectedPosts');
            Route::get('/get/{limit}/{userid}/{roleid}/{user_role_id?}', 'agentSelectedPostsAjx');
        });
        Route::get("/agent/myall/selected/post", 'agentSelectedAllPosts');
    });
});


//admin routes
require __DIR__ . '/admin.php';

//routes by aman

// social logins

Route::get('auth/{provider}/{roleId}', [Front\HomeController::class, 'redirectToProvider']);
Route::get('auth/{provider}/{roleId}/callback', [Front\HomeController::class, 'signupWithProvider']);
