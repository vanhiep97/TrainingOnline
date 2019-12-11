<?php

namespace App\Services;

use App\Repositories\CourseRepository;
use Illuminate\Support\Facades\Auth;

class CourseService {
    protected $courseRepository;

    public function __construct( CourseRepository $courseRepository ) {
        $this->courseRepository = $courseRepository;
    }

    public function getCourses() {
        return $this->courseRepository->all();
    }

    public function findBySlug( $slug ) {
        return $this->courseRepository->findBy( 'slug', $slug );
    }

    public function randomCourse( $limit = 3 ) {
        return $this->courseRepository->query()->orderByRaw( 'RAND()' )->limit( $limit )->get();
    }

    public function coursesRelation( $courseId ) {
        return $this->courseRepository->query()->where( 'id', '!=', $courseId )->get();
    }

    public function coursedRegister() {
        return $this->courseRepository->query()
                                      ->join( 'user_courses', 'user_courses.course_id', '=', 'courses.id' )
                                      ->where( 'user_courses.user_id', '=', Auth::user()->id )
                                      ->get();
    }

    public function findById( $id ) {
        return $this->courseRepository->get( $id );
    }

    public function create($course) {
        return $this->courseRepository->query()->create($course);
    }

    public function update( $id, $course ) {
        return $this->courseRepository->get( $id )->update( $course );
    }

    public function delete( $id ) {
        return $this->courseRepository->get( $id )->delete();
    }

    public function showCourseDetail( $id ) {
        return $this->courseRepository->query()
                                      ->join( 'teachers as teacher', 'teacher.id', '=', 'courses.teacher_id' )
                                      ->select( 'courses.id as course_id', 'courses.name as course_name',
                                          'courses.slug as course_slug', 'courses.description as course_description',
                                          'courses.intro as course_intro', 'courses.image as course_image',
                                          'courses.social_image as course_social_image', 'courses.type as course_type',
                                          'courses.created_at as course_created_at', 'courses.updated_at as course_updated_at',
                                          'teacher.id as teacher_id', 'teacher.name as teacher_name', 'teacher.email as teacher_email',
                                          'teacher.phone as teacher_phone', 'teacher.facebook as teacher_facebook',
                                          'teacher.zalo as teacher_zalo', 'teacher.address as teacher_address',
                                          'teacher.experience as teacher_experience', 'teacher.created_at as teacher_created_at',
                                          'teacher.updated_at as teacher_updated_at' )
                                      ->where( 'courses.id', '=', $id )->get();
    }
}
