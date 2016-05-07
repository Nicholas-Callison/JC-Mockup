<style>
  .td16bold{
	width:16%;
	text-align:center;
	font-weight:bold;
	border:inherit;
  }
  .td8bold{
	width:8%;
	text-align:center;
	font-weight:bold;
	border:inherit;
  }
  .td12bold{
	width:12%;
	text-align:center;
	font-weight:bold;
	border:inherit;
  }
  .td14bold{
	width:14%;
	text-align:center;
	font-weight:bold;
	border:inherit;
  }
  .td18bold{
	width:18%;
	text-align:center;
	font-weight:bold;
	border:inherit;
  }
  td.content{
	border:inherit;
  }
  
  
  ul{
	background-color:inherit;
	list-style-type: circle;
  }
  li{
	list-style-type: inherit;
  }
  li:hover{
	background-color: inherit;
	color: inherit;
  }
  
  
  table{
	border: 1px solid black;
  }
  tr{
	border: 1px solid black;
  }
</style>




<div class="container-fluid">

<div class="row">
<div class="col-md-2">
	<a href="#">Click here to start over</a>
</div><!--column-->
</div><!--row-->

	<?php
        $map_id = map_by_name_type_start($tokens[2], $tokens[3], $tokens[4]);
        $semesters = map_semester_list($map_id);
        foreach ($semesters as &$semester):
    ?>

<!--Main loop start-->
<div class="row">
<div class="col-md-12">
<table style="width:100%; border: 1px solid black;">							<!--Table-->
	<tr>
        <th colspan="4">Computer Programming Specialist</th>
        <th colspan="3" style="text-align:right">Year 1 - Fall</th>
    </tr>
	<tr>
        <td class="td16bold">Course</td>
        <td class="td8bold"># Credits</td>
        <td class="td16bold">Milestones and Activities</td>
        <td class="td12bold">Prerequisites</td>
        <td class="td16bold">This is a Prerequisite for what courses?</td>
        <td class="td18bold">Type of Course for this degree</td>
    </tr>

    <?php
    $courses = get_semester_courses($semester['id']);
    foreach ($courses as &$course):
    ?>
	<tr><td class="content"><?php printf("%s-%03d: %s <br />", $course['code'], $course['number'], $course['title']); ?></td>
        <td class="content"><?= $course['credits'] ?></td>
        <td class="content"><?= $course['milestone'] ?></td>
        <td class="content">
            <?php 
                $prereqs = get_prerequisites($course['cid']);
                foreach ($prereqs as &$prereq) {
                    printf("%s-%03d <br />", $prereq['code'], $prereq['number']);
                }
            ?>
        </td>
        <td class="content">
            <?php
                $depends = get_dependent_courses($course['id'], $map_id);
                foreach ($depends as &$depend) {
                    printf("%s-%03d <br />", $depend['code'], $depend['number']);
                }
            ?>
        </td>
        <td class="content"><ul><li><?= $course['type'] ?></li></ul></td>
    </tr>
        <?php endforeach; ?>
</table>
</div><!--column-->
</div><!--row-->
            <?php endforeach; ?>