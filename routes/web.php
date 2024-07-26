<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Models\AccountRequest;
use App\Models\Club;
use App\Models\Dojo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('authentication.login');
});

Route::get('/logout', [AuthController::class, 'logoutWeb'])->name('logout.web');
Route::post('/sign-in', [AuthController::class, 'loginWeb'])->name('login.web');
Route::post('/reset-password', [AuthController::class, 'resetPasswordWeb'])->name('resetPassword.web');/* Pour le formulaire de réinitialisation de mot de passe*/
Route::get('/reinitalize-password/{id}', [UserRegisterController::class, 'ReinitialisationPassword'])->name('reinitializePassword.web'); /* L'action admin pour changer le mot de passe d'un individu */
Route::get('/activate-account/{id}', [UserRegisterController::class, 'ActivateAccountWeb'])->name('activateAccount.web');
Route::get('/desactivate-account/{id}', [UserRegisterController::class, 'DesactivateAccountWeb'])->name('desactivateAccount.web');






















Route::group(['prefix' => 'main', 'as' => 'main.'], function () {

    //les dashboards
    Route::get('/admin-dashboard', function () {
        return view('main.adminDashboard');
    })->name('adminDashboard');

    Route::get('/studentDashboard.blade.php', function () {
        return view('main.studentDashboard');
    })->name('studentDashboard');

    Route::get('/teacherDashboard.blade.php', function () {
        return view('main.teacherDashboard');
    })->name('teacherDashboard');

});


//authentication

Route::group(['as' => 'authentication.'], function () {
    Route::get('/login', function () {
        return view('authentication.login');
    })->name('login');

    Route::get('/register', function () {
        return view('authentication.register');
    })->name('register');

    Route::get('/reset-password/{id}', function (Request $request) {

        $user = User::where('id', $request->id)->first();
        return view('authentication.reset-password', ['user', $user]);
    })->name('reset-password');


   /* Route::post('/reset-password', function (Request $request) {

        $user = User::where('id', $request->id)->first();
        return view('authentication.reset-password', ['user', $user]);
    })->name('reset-password');*/


    Route::get('/error-404', function () {

    })->name('error-404');
});



Route::group(['prefix' => 'partials', 'as' => 'partials.'], function () {
    Route::get('/profile', function () {
        return view('partials.profile');
    })->name('profile');

    Route::get('/inbox', function () {
        return view('partials.inbox');
    })->name('inbox');

    Route::get('/login', function () {
        return view('partials.login');
    })->name('login');
});


Route::group(['prefix' => 'main/student', 'as' => 'main.student.'], function () {
    Route::get('/students', function () {
        return view('main.student.students');
    })->name('students');

    Route::get('/student-details/{id}', function (Request $request) {
        $request = AccountRequest::where('id', $request->id)->first();
        return view('main.student.student-details', ['selectedRequest' => $request]);
    })->name('student-details');



    Route::get('/add-student', function () {
        return view('main.student.add-student');
    })->name('add-student');

    Route::get('/edit-student', function () {
        return view('main.student.edit-student');
    })->name('edit-student');

    Route::get('/grid', function () {
        return view('main.student.students-grid');
    })->name('grid-student');
});

Route::group(['prefix' => 'main/accountRequest', 'as' => 'main.accountRequest.'], function () {
    Route::get('/requests', function () {
        return view('main.student.students');
    })->name('requests');

    Route::get('/request-details/{id}', function (Request $request) {
        $request = AccountRequest::where('id', $request->id)->first();
        return view('main.accountRequest.request-details', ['selectedRequest' => $request]);
    })->name('request-details');

});


Route::group(['prefix' => 'users/', 'as' => 'main.user.'], function () {
    Route::get('/list', function () {
        return view('main.user.users');
    })->name('users');

    Route::get('/details/{id}', function (Request $request) {
        $request = User::where('id', $request->id)->first();
        return view('main.user.user-details', ['selectedUser' => $request]);
    })->name('user-details');

    Route::get('/add', function (Request $request) {
        return view('main.user.add-user');
    })->name('add-user');

    Route::get('/edit/{id}', function (Request $request) {
        return view('main.user.edit-user');
    })->name('edit-user');

});


Route::group(['prefix' => 'main/sensei', 'as' => 'main.sensei.'], function () {
    Route::get('/senseis', function () {
        return view('template.teachers');
    })->name('senseis');

    Route::get('/teacher-details', function () {
        return view('main.sensei.teacher-details');
    })->name('teacher-details');

    Route::get('/add-teacher', function () {
        return view('main.sensei.add-teacher');
    })->name('add-teacher');

    Route::get('/edit-teacher', function () {
        return view('main.sensei.edit-teacher');
    })->name('edit-teacher');
});

Route::group(['prefix' => 'main/department', 'as' => 'main.department.'], function () {
    Route::get('/departments', function () {
        return view('main.department.departments');
    })->name('departments');

    Route::get('/add-department', function () {
        return view('main.department.add-department');
    })->name('add-department');


    Route::get('/edit-department/{id}', function (Request  $request) {

        $selectedClub = Club::find($request->id);
        return view('main.department.edit-department', ['selectedClub' => $selectedClub]);

    })->name('edit-department');

    Route::get('/department-details/{id}', function (Request  $request) {

        $selectedClub = Club::find($request->id);
        return view('main.department.department-details', ['selectedClub' => $selectedClub]);

    })->name('department-details');
});


Route::group(['prefix' => 'main/dojo', 'as' => 'main.dojo.'], function () {
    Route::get('/dojos', function () {
        return view('main.dojo.dojos');
    })->name('dojos');

    Route::get('/add-dojo', function () {
        return view('main.dojo.add-dojo');
    })->name('add-dojo');


    Route::get('/edit-dojo/{id}', function (Request  $request) {

        $selectedDojo = Dojo::find($request->id);
        return view('main.dojo.edit-dojo', ['selectedDojo' => $selectedDojo]);

    })->name('edit-dojo');

    Route::get('/dojo-details/{id}', function (Request  $request) {

        $selectedDojo = Dojo::find($request->id);
        return view('main.dojo.dojo-details', ['selectedDojo' => $selectedDojo]);

    })->name('dojo-details');
});

Route::group(['prefix' => 'main/subject', 'as' => 'main.subject.'], function () {
    Route::get('/subjects', function () {
        return view('main.subject.subjects');
    })->name('subjects');

    Route::get('/add-subject', function () {
        return view('main.subject.add-subject');
    })->name('add-subject');

    Route::get('/edit-subject', function () {
        return view('main.subject.edit-subject');
    })->name('edit-subject');
});

Route::group(['prefix' => 'main/invoice', 'as' => 'main.invoice.'], function () {
    Route::get('/invoices', function () {
        return view('main.invoice.invoices');
    })->name('invoices');

    Route::get('/invoice-grid', function () {
        return view('main.invoice.invoice-grid');
    })->name('invoice-grid');

    Route::get('/add-invoice', function () {
        return view('main.invoice.add-invoice');
    })->name('add-invoice');

    Route::get('/edit-invoice', function () {
        return view('main.invoice.edit-invoice');
    })->name('edit-invoice');

    Route::get('/view-invoice', function () {
        return view('main.invoice.view-invoice');
    })->name('view-invoice');

    Route::get('/invoices-settings', function () {
        return view('main.invoice.invoices-settings');
    })->name('invoices-settings');
});


Route::group(['prefix' => 'main/account', 'as' => 'main.account.'], function () {
    Route::get('/fees-collections', function () {
        return view('main.account.fees-collections');
    })->name('fees-collections');

    Route::get('/expenses', function () {
        return view('main.account.expenses');
    })->name('expenses');

    Route::get('/salary', function () {
        return view('main.account.salary');
    })->name('salary');

    Route::get('/add-fees-collection', function () {
        return view('main.account.add-fees-collection');
    })->name('add-fees-collection');

    Route::get('/add-expenses', function () {
        return view('main.account.add-expenses');
    })->name('add-expenses');

    Route::get('/add-salary', function () {
        return view('main.account.add-salary');
    })->name('add-salary');
});

Route::get('/main/holiday', function () {
    return view('main.holiday.holiday');
})->name('main.holiday.holiday');

Route::get('/main/fee', function () {
    return view('main.fee.fees');
})->name('main.fee.fees');

Route::get('/main/exam', function () {
    return view('main.exam.exam');
})->name('main.exam.exam');

Route::get('/main/event', function () {
    return view('main.event.event');
})->name('main.event.event');

Route::get('/main/timetable', function () {
    return view('main.timetable.time-table');
})->name('main.timetable.time-table');

Route::get('/main/library', function () {
    return view('main.library.library');
})->name('main.library.library');

Route::group(['prefix' => 'main/blog', 'as' => 'main.blog.'], function () {
    Route::get('/blog', function () {
        return view('main.blog.blog');
    })->name('blog');

    Route::get('/add-blog', function () {
        return view('main.blog.add-blog');
    })->name('add-blog');

    Route::get('/edit-blog', function () {
        return view('main.blog.edit-blog');
    })->name('edit-blog');
});


Route::group(['prefix' => 'main/setting', 'as' => 'main.setting.'], function () {
    Route::get('/settings', function () {
        return view('main.setting.settings');
    })->name('settings');

    Route::get('/blank-page', function () {
        return view('main.setting.blank-page');
    })->name('blank-page');
});



Route::get('/main/sport/sports', function () {
    return view('main.sport.sports');
})->name('main.sport.sports');

Route::get('/main/hotel/hostel', function () {
    return view('main.hotel.hostel');
})->name('main.hotel.hostel');

Route::get('/main/transport/transport', function () {
    // Handle transport view or redirect appropriately
})->name('main.transport.transport');

Route::group(['prefix' => 'main/ui/baseUI', 'as' => 'main.ui.baseUI.'], function () {
    Route::get('/alerts', function () {
        return view('main.ui.baseUI.alerts');
    })->name('alerts');

    Route::get('/accordions', function () {
        return view('main.ui.baseUI.accordions');
    })->name('accordions');

    Route::get('/avatar', function () {
        return view('main.ui.baseUI.avatar');
    })->name('avatar');

    Route::get('/badges', function () {
        return view('main.ui.baseUI.badges');
    })->name('badges');

    Route::get('/buttons', function () {
        return view('main.ui.baseUI.buttons');
    })->name('buttons');

    Route::get('/buttongroup', function () {
        return view('main.ui.baseUI.buttongroup');
    })->name('buttongroup');

    Route::get('/breadcrumbs', function () {
        return view('main.ui.baseUI.breadcrumbs');
    })->name('breadcrumbs');

    Route::get('/cards', function () {
        return view('main.ui.baseUI.cards');
    })->name('cards');

    Route::get('/carousel', function () {
        return view('main.ui.baseUI.carousel');
    })->name('carousel');

    Route::get('/dropdowns', function () {
        return view('main.ui.baseUI.dropdowns');
    })->name('dropdowns');

    Route::get('/grid', function () {
        return view('main.ui.baseUI.grid');
    })->name('grid');

    Route::get('/images', function () {
        return view('main.ui.baseUI.images');
    })->name('images');

    Route::get('/lightbox', function () {
        return view('main.ui.baseUI.lightbox');
    })->name('lightbox');

    Route::get('/media', function () {
        return view('main.ui.baseUI.media');
    })->name('media');

    Route::get('/modal', function () {
        return view('main.ui.baseUI.modal');
    })->name('modal');

    // Routes à compléter :
    Route::get('/offcanvas', function () {
        return view('main.ui.baseUI.offcanvas');
    })->name('offcanvas');

    Route::get('/pagination', function () {
        return view('main.ui.baseUI.pagination');
    })->name('pagination');

    Route::get('/popover', function () {
        return view('main.ui.baseUI.popover');
    })->name('popover');

    Route::get('/progress', function () {
        return view('main.ui.baseUI.progress');
    })->name('progress');

    Route::get('/placeholders', function () {
        return view('main.ui.baseUI.placeholders');
    })->name('placeholders');

    Route::get('/rangeslider', function () {
        return view('main.ui.baseUI.rangeslider');
    })->name('rangeslider');

    Route::get('/spinners', function () {
        return view('main.ui.baseUI.spinners');
    })->name('spinners');

    Route::get('/sweetalerts', function () {
        return view('main.ui.baseUI.sweetalerts');
    })->name('sweetalerts');

    Route::get('/tab', function () {
        return view('main.ui.baseUI.tab');
    })->name('tab');

    Route::get('/toastr', function () {
        return view('main.ui.baseUI.toastr');
    })->name('toastr');

    Route::get('/tooltip', function () {
        return view('main.ui.baseUI.tooltip');
    })->name('tooltip');

    Route::get('/typography', function () {
        return view('main.ui.baseUI.typography');
    })->name('typography');

    Route::get('/video', function () {
        return view('main.ui.baseUI.video');
    })->name('video');
});


Route::group(['prefix' => 'main/ui/element', 'as' => 'main.ui.element.'], function () {
    Route::get('/ribbon', function () {
        return view('main.ui.elements.ribbon');
    })->name('ribbon');

    Route::get('/clipboard', function () {
        return view('main.ui.elements.clipboard');
    })->name('clipboard');

    Route::get('/drag-drop', function () {
        return view('main.ui.elements.drag-drop');
    })->name('drag-drop');

    Route::get('/rating', function () {
        return view('main.ui.elements.rating');
    })->name('rating');

    Route::get('/text-editor', function () {
        return view('main.ui.elements.text-editor');
    })->name('text-editor');

    Route::get('/counter', function () {
        return view('main.ui.elements.counter');
    })->name('counter');

    Route::get('/scrollbar', function () {
        return view('main.ui.elements.scrollbar');
    })->name('scrollbar');

    Route::get('/notification', function () {
        return view('main.ui.elements.notification');
    })->name('notification');

    Route::get('/stickynote', function () {
        return view('main.ui.elements.stickynote');
    })->name('stickynote');

    Route::get('/timeline', function () {
        return view('main.ui.elements.timeline');
    })->name('timeline');

    Route::get('/horizontal-timeline', function () {
        return view('main.ui.elements.horizontal-timeline');
    })->name('horizontal-timeline');

    Route::get('/form-wizard', function () {
        // Handle form wizard view or redirect appropriately
    })->name('form-wizard');
});


//chartJS

Route::group(['prefix' => 'main/ui/charts', 'as' => 'main.ui.charts.'], function () {
    Route::get('/chart-apex', function () {
        return view('main.ui.charts.chart-apex');
    })->name('chart-apex');

    Route::get('/chart-js', function () {
        return view('main.ui.charts.chart-js');
    })->name('chart-js');

    Route::get('/chart-morris', function () {
        return view('main.ui.charts.chart-morris');
    })->name('chart-morris');

    Route::get('/chart-flot', function () {
        return view('main.ui.charts.chart-flot');
    })->name('chart-flot');

    Route::get('/chart-peity', function () {
        return view('main.ui.charts.chart-peity');
    })->name('chart-peity');

    Route::get('/chart-c3', function () {
        return view('main.ui.charts.chart-c3');
    })->name('chart-c3');
});


//icons
Route::group(['prefix' => 'main/ui/icons', 'as' => 'main.ui.icons.'], function () {
    Route::get('/icon-fontawesome', function () {
        return view('main.ui.icons.icon-fontawesome');
    })->name('icon-fontawesome');

    Route::get('/icon-feather', function () {
        return view('main.ui.icons.icon-feather');
    })->name('icon-feather');

    Route::get('/icon-ionic', function () {
        return view('main.ui.icons.icon-ionic');
    })->name('icon-ionic');

    Route::get('/icon-material', function () {
        return view('main.ui.icons.icon-material');
    })->name('icon-material');

    Route::get('/icon-pe7', function () {
        return view('main.ui.icons.icon-pe7');
    })->name('icon-pe7');

    Route::get('/icon-simpleline', function () {
        return view('main.ui.icons.icon-simpleline');
    })->name('icon-simpleline');

    Route::get('/icon-themify', function () {
        return view('main.ui.icons.icon-themify');
    })->name('icon-themify');

    Route::get('/icon-weather', function () {
        return view('main.ui.icons.icon-weather');
    })->name('icon-weather');

    Route::get('/icon-typicon', function () {
        return view('main.ui.icons.icon-typicon');
    })->name('icon-typicon');

    Route::get('/icon-flag', function () {
        // Handle icon flag view or redirect appropriately
    })->name('icon-flag');
});


Route::group(['prefix' => 'main/ui/forms', 'as' => 'main.ui.forms.'], function () {

    Route::get('/form-basic-inputs', function () {
        return view('main.ui.forms.form-basic-inputs');
    })->name('form-basic-inputs');

    Route::get('/form-input-groups', function () {
        return view('main.ui.forms.form-input-groups');
    })->name('form-input-groups');

    Route::get('/form-horizontal', function () {
        return view('main.ui.forms.form-horizontal');
    })->name('form-horizontal');

    Route::get('/form-vertical', function () {
        return view('main.ui.forms.form-vertical');
    })->name('form-vertical');

    Route::get('/form-mask', function () {
        return view('main.ui.forms.form-mask');
    })->name('form-mask');

    Route::get('/form-validation', function () {
        // Handle form validation view or redirect appropriately
    })->name('form-validation');
});


Route::group(['prefix' => 'main/ui/tables', 'as' => 'main.ui.tables.'], function () {
    Route::get('/tables-basic', function () {
        return view('main.ui.tables.tables-basic');
    })->name('tables-basic');

    Route::get('/data-tables', function () {
        return view('main.ui.tables.data-tables');
    })->name('data-tables');
});



