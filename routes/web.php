<?php

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
 

Route::group(['middleware' => ['web']], function()
{

	Route::get('/', 'pagesController@index');

	Route::post('signup', [
		'uses' => 'userController@Signup',
		'as' => 'signup'
	]);

	Route::get('scontent', [
		'uses' => 'userController@seecontents',
		'as' => 'scontents'
	]);

	Route::get('sstudents', [
		'uses' => 'userController@seestudents',
		'as' => 'sstudents'
	]);

	Route::post('sstudents', [
		'uses' => 'userController@Students',
		'as' => 'seestudents'
	]);

	Route::post('/setoutline', [
		'uses' => 'userController@setOutline',
		'as' => 'setoutline'
	]);

	Route::get('/final', [
		'uses' => 'adminController@finalStatistics',
		'as' => 'final'
	]);
	
	Route::post('checklogin', [
		'uses' => 'userController@checklogin',
		'as' => 'checklogin'
	]);

	Route::get('/logout', [
		'uses' => 'userController@logout',
		'as' => 'logout'
	]);


	//user or teachers
	Route::get('download/content', 'userController@downloadContent')->name('content.download');
	Route::get('download/outlined', 'userController@downloadoutline')->name('outline.download');
	Route::get('download/final', 'adminController@downloadfinal')->name('final.download');
	Route::get('sload', 'userController@sload')->name('sload');

	Route::get('setOutline', 'userController@Outline')->name('course.outline');

	Route::post('setopic', 'userController@setCourseTopic')->name('course.setopic');
	Route::post('setsection', 'userController@setCourseSection')->name('course.setsection');
	Route::post('setsubsection', 'userController@setCourseSubSection')->name('course.setsubsection');

	Route::get('seeoutline', 'userController@seeoutline')->name('course.seeoutline');
	Route::get('update-outline', 'userController@UpdateOutline')->name('outline.update');
	Route::post('update-outlinefunction', 'userController@UpdateOutlineFunction')->name('outline.updatefuction');
	Route::post('savesubsection', 'lessonController@SaveSubsection')->name('savesubsection');
	Route::get('file/mark_register', 'userController@SelectCourse')->name('teacher.selectcourse');
	Route::get('file/markregister', 'userController@TeacherRegister')->name('teacher.markregister');
	Route::get('checkregister', 'userController@TeacherCheckRegister')->name('teacher.checkregister');
	Route::get('registerstatistics', 'userController@Course_Statistics')->name('teacher.registerstatistics');
	Route::get('check_register', 'userController@checkregister');
	Route::get('removeselectedstudent', 'userController@removeselectedstudent')->name('teacher.removeselectedstudent');
	Route::get('course_covered', 'userController@coursecovered');
	Route::get('coursecovered/', 'userController@CourseCoveredFunction')->name('teacher.coursecovered');
	Route::get('endlecture/', 'userController@TeacherEndLecture')->name('teacher.endlecture');
	Route::get('clearnotifocation/{course}', 'lessonController@ClearNotifocation')->name('clearnotifocation');


	// lessons being taught
	Route::post('file/markregister', ['uses' => 'lessonController@lesson', 'as' => 'lessons']);

	//students
	Route::get('slogin/', 'stlogController@loginform')->name('student.slogin');

	Route::post('slogin/', 'stlogController@slogin')->name('student.login');
	Route::get('download', 'studentController@downloadV')->name('content.sdownload');
	Route::get('outlined', 'studentController@downloadoutline')->name('outline.sdownload');

	Route::get('shome', 'studentController@index')->name('student.shome');
	Route::get('courses', 'studentController@registeredcourses')->name('courses');
	Route::get('sinclude', 'studentController@sinclude');

	Route::get('student_markregister', 'studentController@MarkregView')->name('student.markreg');
	Route::get('markregister', 'studentController@Markregisterfunction')->name('markregsterfunction');
	Route::get('mregistershow', 'studentController@MarkRegShow')->name('register.show');

	Route::get('/studentlogout', ['uses' => 'stlogController@studentlogout', 'as' => 'student.logout']);


	// student register marking
Route::post('lessonone/', ['uses' => 'studentregisterController@lesson_one', 'as' => 'lessonone']);
Route::post('lessontwo/', ['uses' => 'studentregisterController@lesson_two', 'as' => 'lessontwo']);
Route::post('lessonthree/', ['uses' => 'studentregisterController@lesson_three', 'as' => 'lessonthree']);
Route::post('lessonfour/', ['uses' => 'studentregisterController@lesson_four', 'as' => 'lessonfour']);
Route::post('lessonfive/', ['uses' => 'studentregisterController@lesson_five', 'as' => 'lessonfive']);
Route::post('lessonsix/', ['uses' => 'studentregisterController@lesson_six', 'as' => 'lessonsix']);
Route::post('lessonseven/', ['uses' => 'studentregisterController@lesson_seven', 'as' => 'lessonseven']);
Route::post('lessoneight/', ['uses' => 'studentregisterController@lesson_eight', 'as' => 'lessoneight']);
Route::post('lessonnine/', ['uses' => 'studentregisterController@lesson_nine', 'as' => 'lessonnine']);
Route::post('lessonten/', ['uses' => 'studentregisterController@lesson_ten', 'as' => 'lessonten']);
Route::post('lessoneleven/', ['uses' => 'studentregisterController@lesson_eleven', 'as' => 'lessoneleven']);
Route::post('lessontwelve/', ['uses' => 'studentregisterController@lesson_twelve', 'as' => 'lessontwelve']);
Route::post('lessonthirteen/', ['uses' => 'studentregisterController@lesson_thirteen', 'as' => 'lessonthirteen']);
Route::post('lessonfourteen/', ['uses' => 'studentregisterController@lesson_fourteen', 'as' => 'lessonfourteen']);
Route::post('lessonfiveteen/', ['uses' => 'studentregisterController@lesson_fiveteen', 'as' => 'lessonfiveteen']);
Route::post('lessonsixteen/', ['uses' => 'studentregisterController@lesson_sixteen', 'as' => 'lessonsixteen']);
Route::post('lessonseventeen/', ['uses' => 'studentregisterController@lesson_seventeen', 'as' => 'lessonseventeen']);
Route::post('lessoneighteen/', ['uses' => 'studentregisterController@lesson_eighteen', 'as' => 'lessoneighteen']);
Route::post('lessonnineteen/', ['uses' => 'studentregisterController@lesson_nineteen', 'as' => 'lessonnineteen']);
Route::post('lessontwenty/', ['uses' => 'studentregisterController@lesson_twenty', 'as' => 'lessontwenty']);
Route::post('lessontwentyone/', ['uses' => 'studentregisterController@lesson_twenty_one', 'as' => 'lessontwentyone']);
Route::post('lessontwentytwo/', ['uses' => 'studentregisterController@lesson_twenty_two', 'as' => 'lessontwentytwo']);
Route::post('lessontwentythree/', ['uses' => 'studentregisterController@lesson_twenty_three', 'as' => 'lessontwentythree']);
Route::post('lessontwentyfour/', ['uses' => 'studentregisterController@lesson_twenty_four', 'as' => 'lessontwentyfour']);
Route::post('lessontwentyfive/', ['uses' => 'studentregisterController@lesson_twenty_five', 'as' => 'lessontwentyfive']);
Route::post('lessontwentysix/', ['uses' => 'studentregisterController@lesson_twenty_six', 'as' => 'lessontwentysix']);
Route::post('lessontwentyseven/', ['uses' => 'studentregisterController@lesson_twenty_seven', 'as' => 'lessontwentyseven']);
Route::post('lessontwentyeight/', ['uses' => 'studentregisterController@lesson_twenty_eight', 'as' => 'lessontwentyeight']);
Route::post('lessontwentynine/', ['uses' => 'studentregisterController@lesson_twenty_nine', 'as' => 'lessontwentynine']);
Route::post('lessonthirty/', ['uses' => 'studentregisterController@lesson_thirty', 'as' => 'lessonthirty']);
	
 // pages controller
Route::get('include', 'pagesController@include');
Route::get('userSignup', 'pagesController@userSignup');
Route::get('/home', 'pagesController@home');
Route::get('course_content', 'pagesController@coursecontent')->name('course_content');
Route::get('mark_register', 'pagesController@markregister')->name('mark_register');
Route::get('registered_Students', 'pagesController@registeredStudents');
Route::get('seecontent', 'pagesController@seeContent');
Route::get('conditions', 'pagesController@Condition');

Route::get('footer', 'pagesController@footer');
Route::get('messages', 'pagesController@message');


Auth::routes();

Route::get('admin/', 'Auth\adminLoginController@showLoginForm')->name('admin.login');

Route::post('/', 'Auth\adminLoginController@login')->name('admin.login.submit');

Route::get('include/', 'adminController@Include')->name('admin.include');
Route::get('adminhome/', 'AdminController@index')->name('admin.home');

Route::get('syllabus/', 'adminController@syllabus')->name('admin.syllabus');
Route::get('lecturer/', 'adminController@lecturer')->name('admin.lecturer');
Route::get('statistics/', 'adminController@statistics')->name('admin.statistics');
Route::get('fstatistics/', 'adminController@fstatistics')->name('admin.fstatistics');
Route::get('register/', 'adminController@Register')->name('admin.register');
Route::get('seeregister', 'adminController@seeRegister')->name('admin.seeregister');
Route::get('selectcourse', 'adminController@SelectCourse');//return view
Route::get('coursesregister/', 'adminController@CourseRegister')->name('admin.courseregister');
Route::get('levelregister/', 'adminController@LevelRegister')->name('admin.levelregister');
Route::get('levelstatistics/', 'adminController@LevelStatistics')->name('admin.levelstatistics');
Route::get('departmentstatisticsview/', 'adminController@departmentalStatisticsview');
Route::get('departmentstatistics/', 'adminController@departmentStatistics')->name('admin.departmentalstatistics');
Route::get('allcourseStatistics/', 'adminController@AllcourseStatistics')->name('admin.allcourseStatistics');
Route::get('levelstatisticsview/', 'adminController@levelstatisticsview')->name('admin.levelstatisticsview');
Route::get('levelstatistic/', 'adminController@LevelStatistic')->name('admin.levelstatistic');
Route::get('coursestatistics/', 'adminController@CourseStatistics')->name('admin.coursestatistic');
Route::get('lload', 'adminController@load')->name('lload');
Route::get('logs', 'adminController@log')->name('logs');
Route::get('logg', 'adminController@logg')->name('logg');
Route::get('adownload', 'adminController@DownloadOutline')->name('outline.admindownload');

Route::get('view', 'syllabusController@view')->name('view');
Route::get('create-syllabus', 'syllabusController@create')->name('create');
Route::post('store', 'syllabusController@store')->name('store');
Route::get('edit', 'syllabusController@edit')->name('getedit');
Route::post('update', 'syllabusController@updateContent')->name('content.update');
Route::post('delete/', 'syllabusController@delete')->name('delete');
Route::get('editcontent/', 'syllabusController@EditContent');

Route::get('/adminlogout', ['uses' => 'Auth\adminLoginController@adminlogout', 'as' => 'admin.logout']);



});



// date('Y/m/d');            2017/02/27
//   date('m/d/Y');             02/27/2017
//   date('H:i:s');             08:22:26
//   date('Y-m-d H:i:s');      2017-02-27 08:22:26