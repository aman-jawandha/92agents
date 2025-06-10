<?php

use Illuminate\Support\Facades\Route;
// use App\User;
// use Carbon\Carbon;


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
*/

// Language Route
Route::any('/lang/{lg}', [Front\LangaugeController::class, 'index'])->name('lang.switch');

Route::group(['middleware' => ['lang']], function () {
	Route::controller(Front\HomeController::class)->group(function () {
		// Public Pages
		Route::get('/terms', 'terms')->name('terms');
		Route::get('/privacy', 'privacy')->name('privacy');
		Route::get('/new-terms', 'newTerms')->name('new-terms');
		Route::get('/best-shoots', 'bestShoots')->name('best-shoots');
		Route::get('/incredible-content', 'incredibleContent')->name('incredible-content');
		Route::get('/aboutus', 'aboutus')->name('aboutus');
		Route::get('/agent', 'agent')->name('agent');
		Route::get('/sellers', 'sellers')->name('sellers');
		Route::get('/buyers', 'buyers')->name('buyers');
		Route::get('/contactus', 'contact')->name('contactus');
		Route::post('contactSend', 'contactSend')->name('contactSend');
		
		// Blog Routes
		Route::get('/blogs', 'blogs')->name('blogs');
		Route::get('/blogs/{id}/{title}', 'singleblogs')->name('singleblogs');
		Route::get('/blogs/category/{id}/{title}', 'categoryblogs')->name('categoryblogs');
		Route::post('/blog/comment', 'savecomment')->name('blog.comment');
	});

	Route::get('/downloadContract', [Administrator\ProfileController::class, 'contract'])->name('downloadContract');
});

// Authentication Routes
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
        Route::get('/sendsignupmail/', 'NewUserMailSend')->name('sendsignupmail');

        // Password Reset
        Route::get('/password/reset', 'reset')->name('reset');
    });
    
    Route::controller(Auth\LoginController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/login_api', 'login_api');
        // Logout
        Route::get('/logout', 'logout')->name('logout');
    });

    Route::controller(Auth\ForgotPasswordController::class)->group(function () {
        Route::post('/password/resetcodesend', 'resetcodesend')->name('resetcodesend');
        Route::get('/password/resetcodesendbyadmin/{email}', 'resetcodesendbyadmin');
        Route::get('/password/code/{token}', 'resetpasswordform')->name('resetpasswordform');
        Route::post('/password/resetpassword', 'resetpassword')->name('resetpassword');
    });

    Route::controller(Administrator\ProfileController::class)->group(function () {
        // Mobile
        Route::any('/get_state', 'state')->name('get_state');
        Route::any('/get_city/{state_id}', 'city')->name('get_city');
    });
});

// Advertise Route
Route::get('/advertise', [Front\HomeController::class, 'showadvertise'])->name('advertise');

// Closing Date Routes
Route::get('/inputclosingdate', [Administrator\Search\AgentsSearchController::class, 'inputclosingdate'])->name('inputclosingdate.get');
Route::post('/inputclosingdate', [Administrator\Search\AgentsSearchController::class, 'inputclosingdatestore'])->name('inputclosingdate.post');
Route::get('/closingdatecronjob', [Administrator\Search\AgentsSearchController::class, 'closingdatecronjob'])->name('closingdatecronjob');
Route::any('/postForAgents', [Administrator\Search\BuyerSearchController::class, 'postForAgents'])->name('postForAgents');

// User Routes
Route::group(['middleware' => ['auth', 'lang', 'sTime', 'check-user-activation']], function () {
    Route::controller(Administrator\DashboardController::class)->group(function () {
        // Dashboard
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::controller(Administrator\ProfileController::class)->group(function () {
        // Deletion
        Route::get('/profile/delete', 'delete_page')->name('profile.delete');
        Route::post('/profile/delete', 'delete_profile')->name('profile.delete');
    });

    Route::controller(Administrator\ProfileController::class)->group(function () {
        // Agent Profile
        Route::get('/profile/agent', 'agent')->name('profile.agent');
        Route::get('/profile/agent/personal', 'resume')->name('profile.agent.personal');
        Route::post('/profile/agent/personal', 'resume')->name('profile.agent.personal.post');
        Route::get('/profile/agent/professional', 'resume')->name('profile.agent.professional');
        Route::get('/profile/agent/questions', 'agentsquestions')->name('profile.agent.questions');
        Route::get('/profile/agent/tests', 'agentsquestions')->name('profile.agent.tests');
        Route::get('/profile/agent/settings', 'agentsettings')->name('profile.agent.settings');
        Route::get('/profile/agent/security', 'agentsettings')->name('profile.agent.security');
        Route::get('/profile/agent/password', 'agentsettings')->name('profile.agent.password');
        Route::post('/profile/agent/editfields', 'editfields')->name('profile.agent.editfields');
        Route::post('/profile/agent/editprofilepic', 'editprofilepic')->name('profile.agent.editprofilepic');
        Route::post('/profile/agent/editAgentPersonalProfile', 'editagentprofile')->name('profile.agent.editAgentPersonalProfile');
        Route::post('/profile/agent/sellDetails', 'updateSellDetials')->name('profile.agent.sellDetails');
        Route::post('/profile/agent/editagentprofile', 'editagentprofessionalprofile')->name('profile.agent.editagentprofile');
        Route::get('/profile/{name}/proposal', 'proposal')->name('profile.proposal');
        Route::get('/profile/{name}/documents', 'documents')->name('profile.documents');
    });

    Route::controller(Administrator\Agents\ProposalsController::class)->group(function () {
        // Agent Proposal
        Route::post('/agent/proposal/insert', 'store')->name('agent.proposal.insert');
        Route::get('/agent/proposal/get/{limit}/{userid}/{roleid}', 'show')->name('agent.proposal.get');
        Route::get('/agent/proposal/get/ten/{limit}/{userid}/{roleid}', 'showten')->name('agent.proposal.get.ten');
        Route::get('/agent/proposal/delete/{id}', 'delete')->name('agent.proposal.delete');
        Route::any('/get/proposal/with/shared/{limit}', 'getproposalwithshared')->name('get.proposal.with.shared');
    });

    Route::controller(Administrator\ProfileController::class)->group(function () {
        // Buyer Profile
        Route::get('/profile/buyer', 'buyer')->name('profile.buyer');
        Route::get('/profile/buyer/questions', 'buyerquestions')->name('profile.buyer.questions');
        Route::get('/profile/buyer/tests', 'buyerquestions')->name('profile.buyer.tests');
        Route::get('/profile/agent/getQuestions/{id}', 'getQuestions')->name('profile.agent.getQuestions');
        Route::get('/profile/buyer/settings', 'buyersettings')->name('profile.buyer.settings');
        Route::get('/profile/buyer/personal', 'buyersettings')->name('profile.buyer.personal');
        Route::get('/profile/buyer/security', 'buyersettings')->name('profile.buyer.security');
        Route::get('/profile/buyer/password', 'buyersettings')->name('profile.buyer.password');
        Route::post('/profile/buyer/editfields', 'editfields')->name('profile.buyer.editfields');
        Route::post('/profile/buyer/editbuyerprofile', 'editbuyerprofile')->name('profile.buyer.editbuyerprofile');
        Route::post('/profile/buyer/updateposttitle', 'updateposttitle')->name('profile.buyer.updateposttitle');
    });

    Route::controller(Administrator\Buyer\PostController::class)->group(function () {
        // Buyer Post
        Route::get('/add-new-feature', 'addfeature')->name('add-new-feature');
        Route::get('/profile/buyer/posts', 'index')->name('profile.buyer.posts');
        Route::get('/profile/buyer/compareposts', 'ComparePost')->name('profile.buyer.compareposts');
        Route::any('/profile/buyer/post/get/{limit}', 'getDetailsByAny')->name('profile.buyer.post.get');
        Route::any('/profile/buyer/post/get/selected/{limit}', 'getSelectedDetailsByAny')->name('profile.buyer.post.get.selected');
        Route::get('/profile/buyer/post/details/{post_id}', 'PostDetailsForBuyer')->name('profile.buyer.post.details');
        Route::post('/addClosingDate', 'addClosingDate')->name('addClosingDate');
        Route::get('/profile/buyer/post/details/{post_id}/{compare}', 'PostDetailsForBuyer')->name('profile.buyer.post.details');
        Route::get('/profile/buyer/post/details/agents/get/few/{post_id}/{userid}/{roleid}', 'PostDetailsAgentsGetForBuyerlimitfive')->name('profile.buyer.post.details.agents.get.few');
        Route::get('/profile/buyer/post/details/agents/get/{limit}/{post_id}/{userid}/{roleid}', 'PostDetailsAgentsGetForBuyer')->name('profile.buyer.post.details.agents.get');
        Route::post('/profile/buyer/post/get', 'getpostsingalByAny')->name('profile.buyer.post.get.single');
        Route::post('/profile/buyer/newpost', 'store')->name('profile.buyer.post.new');
    });

    Route::controller(Administrator\Buyer\PostController::class)->group(function () {
        // Seller Post
        Route::get('/profile/seller/posts', 'index')->name('profile.seller.posts');
        Route::get('/profile/seller/compareposts', 'ComparePost')->name('profile.seller.compareposts');
        Route::get('/profile/seller/post/details/{post_id}', 'PostDetailsForBuyer')->name('profile.seller.post.details');
        Route::get('/profile/seller/post/details/{post_id}/{compare}', 'PostDetailsForBuyer')->name('profile.seller.post.details');
        Route::get('/profile/seller/post/details/agents/get/few/{post_id}/{userid}/{roleid}', 'PostDetailsAgentsGetForBuyerlimitfive')->name('profile.seller.post.details.agents.get.few');
        Route::get('/profile/seller/post/details/agents/get/{limit}/{post_id}/{userid}/{roleid}', 'PostDetailsAgentsGetForBuyer')->name('profile.seller.post.details.agents.get');
    });

    Route::controller(Administrator\ProfileController::class)->group(function () {
        // Security Question
        Route::post('/securtyquestion/change', 'securtyquestion')->name('securtyquestion.change');
    });

    Route::controller(Administrator\ProfileController::class)->group(function () {
        // Change Password
        Route::post('/password/changepassword', 'changepassword')->name('changepassword');
    });

    Route::controller(Administrator\ProfileController::class)->group(function () {
        // State, City, Area, Certifications, Specialization, Franchise
        Route::any('/state/get/', 'state')->name('state.get');
        Route::any('/city/get', 'city')->name('city.get');
        Route::any('/city/get/{state_id}', 'city')->name('city.get.by.state');
        Route::any('/area/get/', 'area')->name('area.get');
        Route::any('/certifications/get/', 'certifications')->name('certifications.get');
        Route::any('/specialization/get/', 'specialization')->name('specialization.get');
        Route::any('/franchise/get/', 'franchise')->name('franchise.get');
        Route::any('/franchise/get/{id}', 'franchise')->name('franchise.get.by.id');
    });

    Route::controller(Administrator\UploadAndShareController::class)->group(function () {
        // Upload and Share
        Route::post('/uploadshare/insert', 'store')->name('uploadshare.insert');
        Route::get('/uploadshare/get/{limit}/{userid}/{roleid}', 'show')->name('uploadshare.get');
        Route::get('/uploadshare/get/ten/{limit}/{userid}/{roleid}', 'showten')->name('uploadshare.get.ten');
        Route::get('/uploadshare/delete/{id}', 'delete')->name('uploadshare.delete');
        Route::any('/get/uploaded/files/with/shared/{limit}', 'getfileswithshared')->name('get.uploaded.files.with.shared');
    });

    Route::controller(Administrator\Agents\QuestionAnswers\QuestionAnswersController::class)->group(function () {
        // Question and Answers
        Route::any('/question/get', 'show')->name('question.get');
        Route::any('/questiontoanswer', 'questiontoanswer')->name('questiontoanswer');
        Route::any('/allsubmitquestiontoanswer', 'allsubmitquestiontoanswer')->name('allsubmitquestiontoanswer');
        Route::any('/question/get/only/user', 'getonlyusersquestion')->name('question.get.only.user');
        Route::any('/updatequestion', 'update')->name('question.update');
        Route::any('/insertquestion', 'create')->name('question.insert');
    });

    Route::controller(Administrator\Buyer\ImportanceController::class)->group(function () {
        // Importance
        Route::any('/importance', 'update')->name('importance.update');
        Route::any('/importance/list/', 'index')->name('importance.list');
        Route::get('/importance/get/{limit}/{id}/{roleid}', 'getLimitedDataByAny')->name('importance.get');
        Route::get('/importance/delete/{id}', 'delete')->name('importance.delete');
        Route::post('/importance/delete', 'removeimportancelistquestion')->name('importance.delete.by.post');
    });

    Route::controller(Administrator\SurveyController::class)->group(function () {
        // Survey
        Route::any('/survey/buyers/list/', 'buyersindex')->name('survey.buyers.list');
        Route::any('/survey/agent/list/', 'agentsindex')->name('survey.agent.list');
        Route::any('/survey', 'update')->name('survey.update');
        Route::get('/survey/get/{limit}/{id}/{roleid}', 'getLimitedDataByAny')->name('survey.get');
        Route::get('/survey/delete/{id}', 'delete')->name('survey.delete');
        Route::post('/survey/delete', 'removeservaylistquestion')->name('survey.delete.by.post');
        Route::any('/survey/loop/question/get', 'SurvayLoopQuestion')->name('survey.loop.question.get');
    });

    Route::controller(Administrator\SharedController::class)->group(function () {
        // Shared Data
        Route::post('/shared/data/insert', 'create')->name('shared.data.insert');
        Route::post('/shared/data/delete', 'delete')->name('shared.data.delete');
        Route::post('/shared/question/answer/get', 'getSharedQuestionAndAnswer')->name('shared.question.answer.get');
        Route::post('/shared/upload/files/get', 'getSharedUploadAndFiles')->name('shared.upload.files.get');
        Route::post('/shared/proposals/get', 'getSharedProposals')->name('shared.proposals.get');
        Route::any('/shared/proposals/with/connected/users/by/{proposal_id}/{userid}/{user_role}', 'GetSharedPropsalUsersAndConnectedUers')->name('shared.proposals.with.connected.users');
        Route::any('/shared/documents/with/connected/users/by/{docs_id}/{userid}/{user_role}', 'GetSharedDocumentUsersAndConnectedUers')->name('shared.documents.with.connected.users');
        Route::any('/shared/question/with/connected/users/by/{question_id}/{share_user_type}/{userid}/{user_role}', 'GetSharedQuestionUsersAndConnectedUers')->name('shared.question.with.connected.users');
    });

    Route::controller(Administrator\ProfileController::class)->group(function () {
        // Skills
        Route::any('/skills/get', 'skills')->name('skills.get');
    });

    Route::controller(Administrator\Messages\MessagingChatController::class)->group(function () {
        // Messaging
        Route::get('/messages/', 'index')->name('messages.index');
        // Route::get('/messages/{post_id}', 'index')->name('messages.index');
        Route::get('/messages/{post_id}/{receiver_id}/{receiver_role_id}', 'index')->name('messages.index');
        Route::get('/NewConversation/{post_id}/{receiver_id}/{receiver_role_id}', 'createconversation')->name('messages.newConversation');
        Route::any('/messageslist/get/conversation/{limit}', 'ConversationList')->name('messages.list.get.conversation');
        Route::any('/messageslist/get/conversation/messages/{limit}', 'ConversationMessagesList')->name('messages.list.get.conversation.messages');
        Route::any('/messageslist/get/sended/{limit}', 'SendedMessage')->name('messages.list.get.sended');
        Route::any('/messageslist/get/unread', 'UnreadMessage')->name('messages.list.get.unread');
        Route::any('/insert/new/messages', 'InsertNewMessage')->name('messages.insert.new');
        Route::any('/read/update/messages', 'readupdate')->name('messages.read.update');
    });

    Route::controller(Administrator\ProfileController::class)->group(function () {
        // Public User Connection
        Route::post('/users/public/Connection', 'publicConnection')->name('users.public.connection');
        Route::get('/users/{id}/{roleid}', 'publicUserGet')->name('users.public.get');
    });

    Route::controller(Administrator\BookmarkController::class)->group(function () {
        // Bookmark
        Route::get('/{name}/bookmark/', 'index')->name('bookmark.index');
        Route::post('/bookmark/data/insert', 'create')->name('bookmark.data.insert');
        Route::get('/bookmark/data/delete/{id}', 'delete')->name('bookmark.data.delete');
        Route::get('/bookmarked/get/{id}/{role}/{bookmark_type}/{bookmark_item_id}/{bookmark_item_parent_id}', 'GetBookmarkedList')->name('bookmarked.get');
        Route::get('/bookmarked/list/get/{limit}', 'GetBookmarkListByDashbord')->name('bookmarked.list.get');
        Route::get('/bookmarked/delete/by/{id}', 'delete')->name('bookmarked.delete.by.id');
    });

    Route::controller(Administrator\RatingController::class)->group(function () {
        // Rating
        Route::post('/rating/data/insert', 'create')->name('rating.data.insert');
        Route::get('/rating/data/delete/{id}', 'delete')->name('rating.data.delete');
        Route::get('/rating/get/{id}/{role}/{rating_type}/{rating_item_id}/{rating_item_parent_id}/{receiver_id}/{receiver_role}', 'GetRatingedList')->name('rating.get');
        Route::post('/sendratingforagentbybuyerseller', 'reviewsend')->name('sendratingforagentbybuyerseller');
    });

    Route::controller(Administrator\NotesController::class)->group(function () {
        // Notes
        Route::get('/{name}/notes/', 'index')->name('notes.index');
        Route::post('/notes/data/insert', 'create')->name('notes.data.insert');
        Route::post('/notes/data/update/{id}', 'update')->name('notes.data.update');
        Route::get('/notes/data/delete/{id}', 'delete')->name('notes.data.delete');
        Route::get('/notes/get/{id}/{role}/{notes_type}/{notes_item_id}/{notes_item_parent_id}/{receiver_id}/{receiver_role}', 'GetNotesedList')->name('notes.get');
        Route::get('/notes/list/get/{limit}', 'GetnotesListByDashbord')->name('notes.list.get');
        Route::get('/notes/delete/by/{id}', 'delete')->name('notes.delete.by.id');
    });

    Route::controller(Administrator\ProfileController::class)->group(function () {
        // Applied Post and Agents
        Route::get('/{name}/applied/post/{status}', 'AppliedPostForAgents')->name('appliedposts');
        Route::post('/searchbydate', 'AppliedPostForAgentsByDate')->name('appliedpostsbydate');
        Route::get('/applied/post/list/get/{limit}/{userid}/{roleid}', 'AppliedPostListGetForAgents')->name('applied.post.list.get');
        Route::get('/applied/post/list/get/{limit}/{userid}/{roleid}/{selected}/{user_role_id?}', 'AppliedPostListGetForAgents')->name('applied.post.list.get.with.selected');
    });

    Route::controller(Administrator\ProfileController::class)->group(function () {
        // Connected Jobs
        Route::get('/agent/connected/post', 'ConnectedJobsForAgents')->name('agent.connected.post');
    });

    Route::controller(Administrator\NotificationController::class)->group(function () {
        // Notification
        Route::get('/notification/get/{limit}', 'index')->name('notification.get');
        Route::get('/message/notification/get/{limit}', 'MessageNotification')->name('message.notification.get');
        Route::get('/notification/update/read/{id}', 'update')->name('notification.update.read');
        Route::post('/notification/update/read/by/receiver_id', 'UpdateByReceiver_id')->name('notification.update.read.by.receiver_id');
    });

    Route::controller(Administrator\Compare\CompareController::class)->group(function () {
        // Compare
        Route::any('/compare', 'index')->name('compare.index');
        Route::get('/compare/list/{limit}/{userid}/{role}/{post_id}', 'show')->name('compare.list');
        Route::get('/compared/data/get/{post_id}/{sender_id}/{sender_role}', 'ComparedDataGetByPost')->name('compared.data.get');
        Route::post('/compare/insert', 'create')->name('compare.insert');
        Route::get('/compare/delete/{compare_id}/{user_id}', 'delete')->name('compare.delete');
    });

    Route::controller(Administrator\Buyer\PostController::class)->group(function () {
        // Applied Agents
        Route::get('/appliedagents/{post_id}/{agentid}', 'AppliedAgents')->name('appliedagents');
    });

    Route::controller(Administrator\PaymentController::class)->group(function () {
        // Payment
        Route::post('/paymentagents', 'paymentagents')->name('paymentagents');
        Route::get('/getPaymentByAny/{limit}/{userid}', 'getPaymentByAny')->name('getPaymentByAny');
    });

    Route::controller(Administrator\Search\AgentsSearchController::class)->group(function () {
        // Search Agents Details
        Route::post('/search/agents/details', 'addcomment')->name('comment.addcomment');
    });

    Route::controller(Administrator\BlogController::class)->group(function () {
        // Blog
        Route::get('/buyer/blog', 'index')->name('blog.index');
        Route::post('/buyer/blog', 'blogstore')->name('blog.addblog');
        Route::get('/buyer/blog/{id}', 'delblog')->name('blog.delete');
        Route::get('/buyer/advertisement', 'advertisement')->name('blog.advertisement');
        Route::get('/buyer/get/blog/{id}', 'getSingleBlog')->name('blog.get.single');
        Route::get('/buyer/get/single-blog/{id}', 'getSingleBlogview')->name('blog.get.single.view');
        Route::post('/buyer/blog/update', 'singleBlogUpdate')->name('blog.update');
    });

    Route::controller(Administrator\PaymentController::class)->group(function () {
        // Advertise Payment
        Route::get('/paymentpage/{package_id}', 'paymentpage')->name('paymentpage');
        Route::post('/postPayment', 'postPayment')->name('postPayment');
        Route::get('/paymentStatus', 'paymentStatus')->name('paymentStatus');
    });

    Route::controller(Administrator\Agents\AdController::class)->group(function () {
        // Advertise Management
        Route::get('/manageads', 'manage')->name('manageads');
        Route::any('/configureads/{ad_id?}', 'configureads')->name('configureads');
        Route::get('/adclicks/{ad_id}', 'adclicks')->name('adclicks');
    });

    Route::controller(Administrator\PaymentController::class)->group(function () {
        // Commision Payment
        Route::get('/pendinginvoices', 'pendinginvoices')->name('pendinginvoices');
        Route::post('/pay_pendinginvoices', 'pay_pendinginvoices')->name('pay_pendinginvoices');
        Route::get('/pending/pay/{id}', 'payitnow')->name('payitnow');
        Route::post('/postAgentPayment', 'postAgentPayment')->name('postAgentPayment');
        Route::post('/downloadinvoice', 'downloadinvoice')->name('downloadinvoice');
    });

    Route::controller(Administrator\Agents\AdController::class)->group(function () {
        // Advertise Invoice
        Route::get('/advertiseinvoice/{ad_id}', 'advertiseinvoice')->name('advertiseinvoice');
    });

    Route::controller(Administrator\Agents\PostController::class)->group(function () {
        // Agent Selected Posts
        Route::get('/agent/selected/post', 'agentSelectedPosts')->name('agent.selected.post');
        Route::get('/agent/selected/post/get/{limit}/{userid}/{roleid}/{user_role_id?}', 'agentSelectedPostsAjx')->name('agent.selected.post.get');
        Route::get("/agent/myall/selected/post", "agentSelectedAllPosts")->name('agent.myall.selected.post');
    });

    Route::controller(Administrator\RatingController::class)->group(function () {
        // Review of Post
        Route::get('/reviewofpost/{post_id}', 'reviewofpost')->name('reviewofpost');
    });

});

//admin routes
require __DIR__ . '/admin.php';