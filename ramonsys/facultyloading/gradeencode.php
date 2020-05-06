<?php
	 if (!isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     }

?>
<?php

  	 if (isset($_GET['id'])){			
		$mydb->setQuery("SELECT * 
								FROM  `subject` s,  `course` c  ,class cl
								WHERE s.`COURSE_ID` = c.`COURSE_ID` 
								AND s.`SUBJ_ID`=cl.`SUBJ_ID` 
								AND  s.`SUBJ_ID` = ".$_GET['id']."");
			 $rowcount = $mydb->num_rows();
         if ($rowcount > 0){
			$cur = $mydb->loadSingleResult();
			}		
		}
	  ?>
<div class="row">

   	<div class="col-lg-12">
   		<?php
		check_message();
		?>
   		<div class="panel panel-primary">
   			<div class="panel-heading">
			    <h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> Instructor Class </h3>
			  </div>
			  <div class="panel-body">

			  	<div class="row">
			  		<div class="col-lg-12">
			  			<form class="form-horizontal span4" action="" method="POST">
				    		<table class="table" align="center" >	 
				    			
								  <tbody>				    
							     	<tr>
							     		<td><strong>Subject Code:</strong> <?php echo (isset($cur)) ? $cur->SUBJ_CODE : 'Code' ;?><br/>
							     		<strong>Description:</strong> <?php echo (isset($cur)) ? $cur->SUBJ_DESCRIPTION  : 'Description' ;?><br/>
							     	<!--	<td><?php //echo (isset($cur)) ? $cur->SEMESTER : 'Semester' ;?></td>-->
							     		<strong>Grade and Section:</strong> <?php echo (isset($cur)) ? $cur->COURSE_DESC : 'Course' ;?><br/>
							     	<!--	<td><?php //echo (isset($cur)) ? $cur->COURSE_LEVEL : 'Level' ;?></td>-->
							     		
							     		<strong>Days And Time:</strong> <?php echo (isset($cur)) ? $cur->DAY . ' ' .$cur->C_TIME : 'DaysTime' ;?><br/>
							     	<strong>Room:</strong> <?php echo (isset($cur)) ? $cur->ROOM : 'Room' ;?><br/>
							     	<strong>Section:</strong> <?php echo (isset($cur)) ? $cur->SECTION : 'Room' ;?></td>
							     	 
							     	</tr>
						    	</tbody>
						    </table>
						</form>
			  		</div>
			  	</div>
			  		<div class="row">
				  		<div class="col-lg-12">
				  		<h3 align="left">List of Student</h3>
						   <form action="" Method="POST">  					
							<table id="example" class="table table-striped" cellspacing="0">
							
							  <thead>
							  	<tr id="table" >
							  		<tr>
							  			<th>No.</th>
							  		<th>  ID#.</th>
							  		<th>Fullname</th>
							  		<th>Sex</th>
							  		<th>PRE</th>
							  		<th>MID</th>
							  		<th>FIN</th>
							  		<th>Final AVE.</th>				  		
							  		<th>Remarks</th>
							  	</tr>	
							  </thead>
							  <tbody>
							  	<?php 

							  	global $mydb;
							

							  		$mydb->setQuery(" SELECT * 
													FROM  `grades` g,  `tblstudent` s
													WHERE g.`IDNO` = s.`IDNO` AND g.`SUBJ_ID` =". $_GET['id']." order by s.LNAME ");
							  		loadresult();
							  	
							  		function loadresult(){
							  			global $mydb;
								  		$cur = $mydb->loadResultList();
								  		$i = 0;
										foreach ($cur as $student) {
								  		$i = $i + 1;
								  		echo '<tr>';

								  		echo '<td width="5%" align="center">'.$i .'</td>';
								  		// echo '<td><input type="checkbox" name="selector[]" id="selector[]" value="'.$student->IDNO. '"/>
								  		// 		<a href="edit_studentinfo.php?id='.$student->IDNO.'">' . $student->IDNO.'</a></td>';
								  		echo '<td>' . $student->IDNO.'</td>';
								  		echo '<td>'.$student->STUDENTNAME.'</td>';
								  		echo '<td>'. $student->SEX.'</td>';
								  		echo '<td>'. $student->PRE.'</td>';
								  		echo '<td>'. $student->MID.'</td>';
								  		echo '<td>'. $student->FIN.'</td>';
								  		echo '<td>'. $student->FIN_AVE.'</td>';
								  		echo '<td>'. $student->REMARKS.'</td>';  
								  		echo '</tr>';
								  		}

							  		} 
							  	
							  	?>

			 
							  </tbody>
							 
							</table>
							<div class="btn-group">
							 
							  <!--  <button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button> -->
							</div>
							</form>
				  		</div>
			  		</div>	

			  </div>

			  </div>	
   		</div>	
   	</div>
    	<!-- /.col-lg-12 -->
</div>
