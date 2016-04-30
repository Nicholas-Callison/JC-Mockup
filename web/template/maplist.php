<!---Program--->
<div class="container" style="Padding-top: 54px;">
  <h3 class="header">Please choose your program of study</h3> 
  <div class="panel-group" style="padding-top: 20px">

      <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">	
			<!---Program list--->
			<table class="table table-striped">
                <?php 
                    $programs = map_names_by_pathway(pathway_id_from_name($pathway_name));
                    foreach ($programs as &$program):
                ?>
                <tr>
				    <td class=""><h4><?= $program ?></h4></td>
                    <td class="alignright">
                    <?php
                        $types = map_types_by_map_name($program);
                        foreach ($types as &$type):
                    ?>
                    <a href="<?= get_uri('/program/' . urlify_string($program) . '/' . urlify_string($type), true) ?>" class="btn btn-primary btn-sm"><?= $type ?></a>
                    <?php endforeach; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
			</table>
		</h4>
      </div>
    </div>
  </div>
</div>