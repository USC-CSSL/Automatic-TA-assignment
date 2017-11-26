while($row1 = mysqli_fetch_array($resul1))
							{
								$query2="SELECT * FROM `TA` WHERE `User_Id`='"+$row1['User_Id']+"'";
								$result2=mysqli_query($conn,$query2);
								$row2=mysqli_fetch_array($result2);
											    	
								echo    "
									    <tr>
										<td>".$row1['User_Id']."</td>
										<td>".$row1['Name']."</td>
										<td>".$row1['Username']."</td>
										<td>".$row2['Area']."</td>
										<td>
											<div class='dropdown'>
  												<a id='dLabel' data-target='#' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
    												Action
    												<span class='caret'></span>
  												</a>
												<ul class='dropdown-menu' aria-labelledby='dLabel'>
												   <li><a href=''>View</a></li>
												   <li><a href=''>Update</a></li>
												   <li><a href=''>Delete</a></li>
												  </ul>
												</div>
										</td>
									    </tr>
									";

					    		}
