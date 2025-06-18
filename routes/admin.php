<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth;
use App\Http\Controllers\Administrator;
use Illuminate\Support\Facades\Artisan;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;




// Route::get('/agentadmin', 'Auth\AdminLoginController@getAdminLogin');
// Route::post('agentadmin/login', ['as' => 'admin.login', 'uses' => 'Auth\AdminLoginController@adminAuth']);
// Route::get('/adminlogout', 'Auth\AdminLoginController@logout');
Route::get('/force-logout', function () {
    Auth::logout();
    Session::flush();
});

Route::prefix('agentadmin')->group(function () {

    Route::get('/cache/clear/{type}', function ($type) {
        switch ($type) {
            case 'all':
                Artisan::call('cache:clear');
                Artisan::call('view:clear');
                Artisan::call('route:clear');
                Artisan::call('config:clear');
                Artisan::call('clear-compiled');
                Artisan::call('optimize:clear');
                $message = 'All caches cleared!';
                break;
            case 'app':
                Artisan::call('cache:clear');
                $message = 'Application cache cleared!';
                break;
            case 'view':
                Artisan::call('view:clear');
                $message = 'View cache cleared!';
                break;
            case 'route':
                Artisan::call('route:clear');
                $message = 'Route cache cleared!';
                break;
            case 'config':
                Artisan::call('config:clear');
                $message = 'Configuration cache cleared!';
                break;
            case 'compiled':
                Artisan::call('clear-compiled');
                $message = 'Compiled services and packages cache cleared!';
                break;
            case 'bootstrap':
                Artisan::call('optimize:clear');
                $message = 'Bootstrap cache cleared!';
                break;
            default:
                $message = 'Invalid cache type specified.';
                break;
        }

        return "<h1>{$message}</h1>";
    });

    Route::controller(Auth\AdminLoginController::class)->group(function () {
        Route::get('/', 'getAdminLogin')->name('admin.login.get');
        Route::get('/login', 'getAdminLogin')->name('admin.login.get2');
        Route::post('/login', 'adminAuth')->name('admin.login');
        Route::get('/logout', 'logout')->name('admin.logout');
    });

    Route::middleware(['adminauth', 'adminroles', 'lang'])->group(function () {
        Route::controller(Administrator\Admin\AgentadminController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
            Route::get('/users', 'users')->name('admin.users');
            Route::get('/password', 'changepassword')->name('admin.password');
            Route::get('/post/details/{userid?}/{roleid?}/{post_id?}', 'postdetails')->name('admin.post.details');
            Route::any('/getpostlist', 'getPostList')->name('admin.getpostlist');
            Route::post('/selectagentbyadmin', 'selectagentbyadmin')->name('admin.selectagentbyadmin');
            Route::get('/posts', 'Post')->name('admin.getpost');
            Route::post('/deletepost', 'deletePost')->name('admin.deletepost');
            Route::get('/customer-feedbacks', 'feedbacks')->name('feedbacks');
            Route::delete('/delete-feedback/{id}', 'delete_feedback')->name('delete-feedback');
        });

        Route::controller(Administrator\ProfileController::class)->group(function () {
            Route::post('/password/changepassword', 'changepassword')->name('admin.changepassword');
            Route::get('/applied/post/list/get/{limit}/{userid}/{roleid}', 'AppliedPostListGetForAgents')->name('admin.applied.post.list.get');
        });

        Route::controller(Administrator\Admin\AreaController::class)->group(function () {
            Route::any('/getAreaList', 'getAreaList')->name('admin.getAreaList');
            Route::post('/deleteArea', 'deleteArea')->name('admin.deleteArea');
            Route::get('/areas', 'areas')->name('admin.areas');
            Route::get('/area/{id?}', 'area')->name('admin.area');
            Route::post('saveArea', 'save')->name('admin.saveArea');
        });

        Route::controller(Administrator\Admin\StateController::class)->group(function () {
            Route::any('/getStateList', 'getStateList')->name('admin.getStateList');
            Route::get('/states', 'states')->name('admin.states');
            Route::post('/deleteState', 'deleteState')->name('admin.deleteState');
            Route::get('/state/{id?}', 'state')->name('admin.state');
            Route::post('saveState', 'save')->name('admin.saveState');
        });

        Route::controller(Administrator\Admin\CityController::class)->group(function () {
            Route::any('/getCitiesList', 'getCitiesList')->name('admin.getCitiesList');
            Route::get('/cities', 'cities')->name('admin.cities');
            Route::get('/city/{id?}', 'city')->name('admin.city');
            Route::post('saveCity', 'save')->name('admin.saveCity');
            Route::post('/deleteCity', 'deleteCity')->name('admin.deleteCity');
        });

        Route::controller(Administrator\Admin\FranchiseeController::class)->group(function () {
            Route::any('/getFranchiseeList', 'getFranchiseeList')->name('admin.getFranchiseeList');
            Route::get('/franchisees', 'Franchisees')->name('admin.Franchisees');
            Route::get('/franchisee/{id?}', 'Franchisee')->name('admin.Franchisee');
            Route::post('saveFranchisee', 'save')->name('admin.saveFranchisee');
            Route::post('/deleteFranchisee', 'deleteFranchisee')->name('admin.deleteFranchisee');
        });

        Route::controller(Administrator\Admin\AgentController::class)->group(function () {
            Route::any('/agents/changeDocStatus', 'changeDocStatus')->name('admin.agents.changeDocStatus');
            Route::any('/checkDocument', 'checkDocument')->name('admin.checkDocument');
            Route::any('/getAgentList', 'getAgentList')->name('admin.getAgentList');
            Route::get('/agents', 'agents')->name('admin.agents');
            Route::any('/getClosingDateReportajax/{id}', 'getClosingDateReport')->name('admin.getClosingDateReportajax');
            Route::get('/agents/closingdatereport/{id}', 'closingdatereport')->name('admin.agents.closingdatereport');
            Route::get('/agent/{id?}', 'agent')->name('admin.agent');
            Route::any('saveAgent', 'save')->name('admin.saveAgent');
            Route::post('/deleteAgent', 'deleteAgent')->name('admin.deleteAgent');
            Route::get('/agents/view/{id?}', 'agentsview')->name('admin.agents.view');
            Route::get('/agents/view/{id?}/{role?}', 'agentsview')->name('admin.agents.view');
            Route::get('/agents/activepost/{userid?}/{roleid?}', 'agentactivepost')->name('admin.agents.activepost');
            Route::any('/pendinginvoices', 'pendinginvoices')->name('admin.pendinginvoices');
        });

        Route::controller(Administrator\Admin\SellerbuyerControllor::class)->group(function () {
            Route::any('/getSellerbuyerList', 'getSellerbuyerList')->name('admin.getSellerbuyerList');
            Route::get('/sellerbuyers', 'sellerbuyers')->name('admin.sellerbuyers');
            Route::get('/sellerbuyer/{id?}', 'sellerbuyer')->name('admin.sellerbuyer');
            Route::post('saveSellerbuyer', 'save')->name('admin.saveSellerbuyer');
            Route::post('/deleteSellerbuyer', 'deleteSellerbuyer')->name('admin.deleteSellerbuyer');
            Route::get('/sellerbuyer/view/{id?}', 'sellerbuyerview')->name('admin.sellerbuyer.view');
            Route::get('/sellerbuyer/postlist/{userid?}/{roleid?}', 'sellerbuyerpostlist')->name('admin.sellerbuyer.postlist');
        });

        Route::controller(Administrator\Buyer\PostController::class)->group(function () {
            Route::any('/profile/buyer/post/get/{limit}', 'getDetailsByAny')->name('admin.profile.buyer.post.get');
            Route::get('/profile/buyer/post/details/agents/get/{limit}/{post_id}/{userid}/{roleid}', 'PostDetailsAgentsGetForBuyer')->name('admin.profile.buyer.post.details.agents.get');
            Route::post('/selldetails', 'selldetails')->name('admin.selldetails');
            Route::get('/agentadmin/showdoc', 'showdoc')->name('agentadmin.showdoc');
        });

        Route::controller(Administrator\Admin\ProposalsController::class)->group(function () {
            Route::get('/agent/proposal/get/ten/{limit}/{userid}/{roleid}', 'showten')->name('admin.agent.proposal.get.ten');
            Route::get('/agent/proposal/delete/{id}', 'delete')->name('admin.agent.proposal.delete');
        });

        Route::controller(Administrator\Admin\UploadAndShareController::class)->group(function () {
            Route::get('/uploadshare/get/ten/{limit}/{userid}/{roleid}', 'showten')->name('admin.uploadshare.get.ten');
            Route::get('/uploadshare/delete/{id}', 'delete')->name('admin.uploadshare.delete');
        });

        Route::controller(Administrator\Agents\QuestionAnswers\QuestionAnswersController::class)->group(function () {
            Route::any('/question/get', 'show')->name('admin.question.get');
            Route::any('/question/get/only/user', 'getonlyusersquestion')->name('admin.question.get.only.user');
            Route::any('/updatequestion', 'update')->name('admin.updatequestion');
        });

        Route::controller(Administrator\Admin\SpecializationController::class)->group(function () {
            Route::any('/getSpecializationList', 'getSpecializationList')->name('admin.getSpecializationList');
            Route::get('/specializations', 'specializations')->name('admin.specializations');
            Route::get('/specialization/{id?}', 'specialization')->name('admin.specialization');
            Route::post('/saveSpecialization', 'save')->name('admin.saveSpecialization');
            Route::post('/deleteSpecialization', 'deleteSpecialization')->name('admin.deleteSpecialization');
        });

        Route::controller(Administrator\Admin\CertificationsController::class)->group(function () {
            Route::any('/getcertificationslist', 'getCertificationsList')->name('admin.getcertificationslist');
            Route::get('/certifications', 'Certifications')->name('admin.certifications');
            Route::get('/certificationsaddedit/{id?}', 'Certificationsaddedit')->name('admin.certificationsaddedit');
            Route::post('/savecertifications', 'save')->name('admin.savecertifications');
            Route::post('/deletecertifications', 'deleteCertifications')->name('admin.deletecertifications');
        });

        Route::controller(Administrator\Admin\QuestionAnswersController::class)->group(function () {
            Route::get('/getquestionanswers', 'index')->name('admin.getQuestionAnswers');
            Route::any('/getquestionanswerslist', 'getQuestionAnswersList')->name('admin.getquestionanswerslist');
            Route::post('/deletequestionanswers', 'deleteQuestionAnswers')->name('admin.deletequestionanswers');
            Route::get('/questionanswers/{id?}', 'questioneditadd')->name('admin.QuestionAnswers');
            Route::post('/savequestionanswers', 'create')->name('admin.saveQuestionAnswers');
            Route::get('/questionviewwithanswer/{question_id?}', 'show')->name('admin.questionviewwithanswer');
        });

        Route::controller(Administrator\Admin\SecurtyQuestionController::class)->group(function () {
            Route::get('/getsecurtyquestion', 'index')->name('admin.getsecurtyquestion');
            Route::any('/getsecurtyquestionList', 'getsecurtyquestionList')->name('admin.getsecurtyquestionList');
            Route::post('/deletesecurtyquestion', 'deletesecurtyquestion')->name('admin.deletesecurtyquestion');
            Route::get('/securtyquestionaddedit/{id?}', 'securtyquestionaddedit')->name('admin.securtyquestionaddedit');
            Route::post('/savesecurtyquestion', 'save')->name('admin.savesecurtyquestion');
        });

        Route::controller(Administrator\Admin\NotificationController::class)->group(function () {
            Route::get('/getnotification', 'index')->name('admin.getnotification');
            Route::any('/getNotificationList', 'getNotificationList')->name('admin.getNotificationList');
            Route::post('/deleteNoti', 'deleteNoti')->name('admin.deleteNoti');
        });

        Route::controller(Administrator\Admin\AgentadminController::class)->group(function () {
            Route::get('post/validatepost', 'conent')->name('admin.validatepost');
            Route::post('post/validatepost', 'updatewords')->name('admin.postupdate');
        });

        Route::controller(Administrator\Admin\EmployeeController::class)->group(function () {
            Route::get('employee/addemployee', 'create')->name('admin.employee.add');
            Route::post('addemployee', 'store')->name('admin.addemployee');
            Route::get('employee/employeelist', 'employeelist')->name('admin.employee.employeelist');
            Route::get('employee/changestatus', 'changestatus')->name('employee.changestatus');
            Route::post('employee/delete_employee', 'delete_employee')->name('employee.delete_employee');
            Route::get('blog/addblog', 'showadd')->name('admin.blog.add');
            Route::post('addblog', 'blogstore')->name('admin.addblog');
            Route::get('blog/bloglist', 'bloglist')->name('admin.blog.bloglist');
            Route::get('/blog/editblog/{id}', 'editblog')->name('admin.blog.editblog');
            Route::get('blog/changestatus', 'blogchangestatus')->name('blog.changestatus');
            Route::post('blog/editblog', 'updateblog')->name('admin.updateblog');
            Route::get('blog/category', 'catlist')->name('admin.blog.categorylist');
            Route::post('blog/category', 'catstore')->name('employee.addcat');
            Route::put('blog/category', 'catupdate')->name('employee.updatecat');
            Route::post('employee/deletecat', 'deletecat')->name('employee.deletecat');
        });

        Route::controller(Administrator\Admin\PackageController::class)->group(function () {
            Route::get('/package', 'index')->name('admin.package');
            Route::get('/package/{id?}', 'editpackage')->name('admin.editpackage');
            Route::post('/package', 'updatepackage')->name('admin.updatepackage');
            Route::get('/adrequests', 'adrequests')->name('admin.adrequests');
            Route::get('/adaction/{ad_id}/{action}', 'adaction')->name('admin.adaction');
        });

        Route::controller(Administrator\Admin\ConversationController::class)->group(function () {
            Route::get('/chats', 'chats')->name('admin.chats');
            Route::get('/conversation', 'conversation')->name('admin.conversation');
            Route::get('/conversation/conversationdetails/{id}', 'conversationdetails')->name('admin.conversation.conversationdetails');
        });

        Route::controller(Administrator\Admin\PopinController::class)->group(function () {
            Route::get('/popins', 'popins')->name('admin.popins');
            Route::get('/add-popin', 'add_popin')->name('admin.add-popin');
            Route::post('/store-popin', 'store_popin')->name('admin.store-popin');
            Route::get('/edit-popin/{id}', 'edit_popin')->name('admin.edit-popin');
            Route::post('/update-popin', 'update_popin')->name('admin.update-popin');
            Route::delete('/delete-popin/{id}', 'delete_popin')->name('admin.delete-popin');
        });

        // Clear application cache:
        Route::get('/clear-all-cache', function () {
            Artisan::call('cache:clear');
            Artisan::call('cache:clear');
            Artisan::call('route:cache');
            Artisan::call('config:cache');
            Artisan::call('view:clear');
            return 'All cache has been cleared';
        });

        // Clear application cache:
        Route::get('/clear-cache', function () {
            Artisan::call('cache:clear');
        });
        //Clear route cache:
        Route::get('/route-cache', function () {
            Artisan::call('route:cache');
            return 'Routes cache has been cleared';
        });
        //Clear config cache:
        Route::get('/config-cache', function () {
            Artisan::call('config:cache');
            return 'Config cache has been cleared';
        });
        // Clear view cache:
        Route::get('/view-clear', function () {
            Artisan::call('view:clear');
            return 'View cache has been cleared';
        });
    });
});
