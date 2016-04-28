<?php
include_once("DB.class.php");

/**
 * Get course course information for row in map for one semester
 *
 * @param $map_id int Id of map to use
 *
 * @return array Values that will be put under that map
 */
function get_semester_courses($map_id) {
    if (!$map_id) {
        return array();
    }

    $dbh = DB::connect();

    $q = "SELECT c.code code, c.number number, c.title title, c.credits credits, ";
    $q.= "m.milestone_activity milestone, m.type type";
    $q.= "FROM MapCourse m";
    $q.= "LEFT JOIN Courses c ON m.course_id = c.id";
    $q.= "WHERE m.map_id = " . $map_id;

    $result = $dbh->query($q);

    if (!$result) {
        return array();
    }

    $courses = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $courses[] = $row;
    }

    return $courses;
}

/**
 * Get prerequisites for a course
 *
 * @param $course_id int Course id to get prerequisites for
 *
 * @return array Prerequisite courses
 */
function get_prerequisites($course_id) {
    if (!$course_id) {
        return array();
    }

    $dbh = DB::connect();

    $q = "SELECT c.code code, c.number number ";
    $q.= "FROM Prerequisites p ";
    $q.= "LEFT JOIN Courses c ON c.id = p.prerequisite_id ";
    $q.= "WHERE p.course_id = " . $course_id;

    $result = $dbh->query($q);

    if (!$result) {
        return array();
    }


    $courses = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $courses[] = $row;
    }

    return $courses;
}

/**
 * Get list of classes that depend on a course based on a requirement
 * in a program.
 *
 * @param $course_id int Course id to find dependent classes
 * @param $program_id int Program id for degree program
 *
 * @return array Dependent courses
 */
function get_dependent_courses($course_id, $program_id) {
    if (!$course_id || !$program_id) {
        return array();
    }

    $dbh = DB::connect();

    $q = "SELECT c.code code, c.number number ";
    $q.= "FROM Prerequisites p ";
    $q.= "LEFT JOIN Courses c ON c.id = p.course_id ";
    $q.= "WHERE p.prerequisite_id = " . $course_id . " ";
    $q.= "AND IN (SELECT c.id ";
    $q.= " FROM Courses c ";
    $q.= " LEFT JOIN MapCourse mc ON mc.course_id = c.id ";
    $q.= " LEFT JOIN MapSemesters m ON m.id = mc.map_id ";
    $q.= " LEFT JOIN Maps p ON p.id = m.program_id ";
    $q.= " WHERE p.id = " . $program_id . ")";

    $result = $dbh->query($q);

    if (!$result) {
        return array();
    }

    $courses = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $courses[] = $row;
    }

    return $courses;
}

/**
 * Get id of pathway from formatted string.
 *
 * @param $fmt_name string Name to search for
 *
 * @return int ID of pathway
 */
function pathway_id_from_name($fmt_name) {
    $modified_name = preg_replace("/(_)/", ",", $fmt_name);
    $modified_name = preg_replace("/(-)/", " ", $modified_name);
    $modified_name = preg_replace("/(and)/", "&", $modified_name);
    $modified_name = ucwords($modified_name);

    $dbh = DB::connect();

    $q = "SELECT id ";
    $q.= "FROM Pathways ";
    $q.= "WHERE name = " . $dbh->quote($modified_name);

    $result = $dbh->query($q);

    if (!$result) {
        return 0;
    }

    $row = $result->fetch(PDO::FETCH_NUM);
    return $row[0];
}

/**
 * Get list of unique names of maps
 *
 * @param $pathway_id int Pathway id to query for
 *
 * @return array List of unique Map names
 */
function map_names_by_pathway($pathway_id) {
    $dbh = DB::connect();

    $q = "SELECT DISTINCT name ";
    $q.= "FROM Maps ";
    $q.= "WHERE pathway_id = " . $pathway_id . " ";
    $q.= "ORDER BY name";

    $result = $dbh->query($q);

    if (!$result) {
        return array();
    }

    $name = array();
    while ($row = $result->fetch(PDO::FETCH_NUM)) {
        $name[] = $row;
    }

    return $name;
}

