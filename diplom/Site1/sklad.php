<!DOCTYPE html>
<html style="font-size: 16px;" lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Заказ​ы">
    <meta name="description" content="">
    <title>sklad</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="sklad.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 6.11.6, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": ""
        }
    </script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="sklad">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="intlTelInput/">
	
</head>
<body data-path-to-root="./" data-include-products="false" class="u-body u-xl-mode" data-lang="ru">
<header class="u-clearfix u-gradient u-header u-header" id="sec-650a">
    <div class="u-clearfix u-sheet u-sheet-1">
        <a href="admin.php" class="u-btn u-button-style u-btn-1">Главная </a>
        <div class="u-container-align-center u-container-style u-expanded-width u-grey-10 u-group u-group-1">
            <div class="u-container-layout u-valign-middle u-container-layout-1">
                
            </div>
        </div>
    </div>
</header>
<section class="u-clearfix u-section-1" id="sec-b360">
    <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-container-style u-grey-10 u-group u-group-1">
            <div class="u-container-layout u-valign-top u-container-layout-1">
                <a href="sklad.php" class="u-btn u-button-style u-dialog-link u-btn-1" onclick="toggleForm('addProductForm')">Добавить продукт </a>
                <a href="sklad.php" class="u-btn u-button-style u-dialog-link u-btn-2" onclick="toggleForm('editProductForm')">Редактировать </a>
                <a href="sklad.php" class="u-btn u-button-style u-dialog-link u-btn-3" onclick="toggleForm('delProductForm')">Удалить </a>
            </div>
        </div>
		
        <div class="u-container-style u-grey-5 u-group u-group-2">
			<form id="editProductForm" action="ed_product.php" method="post" style="display: none;">
                <label for="productNameEdit">Название:</label>
                <input type="text" id="productNameEdit" name="productNameEdit" required><br>
                <label for="quantityEdit">Новое количество:</label>
                <input type="number" id="quantityEdit" name="quantityEdit" required><br>
                <label for="necessityEdit">Новое необходимо:</label>
                <input type="text" id="necessityEdit" name="necessityEdit" required><br>
                <input type="submit" value="Сохранить изменения">
            </form>
			<form id="delProductForm" action="del_product.php" method="post" style="display: none;">
                <label for="productNameDel">Название:</label>
                <input type="text" id="productNameDel" name="productNameDel" required><br>
                <input type="submit" value="Удалить">
            </form>
            <div id="notification" style="display: none; color: green;">Новый продукт успешно добавлен</div>
            <form id="addProductForm" action="add_product.php" method="post" style="display: none;">
                <label for="productName">Название:</label>
                <input type="text" id="productName" name="productName" required><br>
                <label for="text">Количество:</label>
                <input type="number" id="quantity" name="quantity" required><br>
                <label for="necessity">Необходимо:</label>
                <input type="text" id="necessity" name="necessity" required><br>
                <input type="submit" value="Добавить">
            </form>
			<table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <tr>
												<th></th>
                                                <th>Название</th>
                                                <th>Количество</th>
                                                <th>Требуется</th>
                                                
                                               	  
                                            </tr>
                                        </thead>
                                        <tbody>
										
                                           
                                               	<?php
												include("connection/connect.php");
												$sql="SELECT * FROM sklad order by id desc";
												$query=mysqli_query($db,$sql);
												
													if(!mysqli_num_rows($query) > 0 )
														{
															echo '<td colspan="11"><center>No Menu</center></td>';
														}
													else
														{				
																	while($rows=mysqli_fetch_array($query))
																		{
																				
																				
																				
																					echo '<tr><td>'.$fetch['namebl'].'</td>
																								<td>'.$rows['namebl'].'</td>
																								<td>'.$rows['colvsklad'].'</td>
																								<td>'.$rows['colvonado'].'</td>
																								
																								
																								
																								<td><div class="col-md-3 col-lg-8 m-b-10">
																								
																								</div></td>
																								
																							
																									 <td><a href="delete_menu.php?menu_del='.$rows['d_id'].'" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
																									 <a href="update_menu.php?menu_upd='.$rows['d_id'].'" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
																									</td></tr>';
																					 
																						
																						
																		}	
														}
												
											
											?>				             
                                        </tbody>
                                    </table>
        </div>
    </div>
</section>
<script>
function toggleForm(formId) {
    var addForm = document.getElementById('addProductForm');
    var editForm = document.getElementById('editProductForm');
    var delForm = document.getElementById('delProductForm');
	
    if (formId === 'addProductForm') {
        addForm.style.display = addForm.style.display === 'none' ? 'block' : 'none';
        editForm.style.display = 'none';
        delForm.style.display = 'none';
    } else if (formId === 'editProductForm') {
        editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
        addForm.style.display = 'none';
        delForm.style.display = 'none';
    } else if (formId === 'delProductForm') {
        delForm.style.display = delForm.style.display === 'none' ? 'block' : 'none';
        addForm.style.display = 'none';
        editForm.style.display = 'none';
    }
}
</script>
<script>
function showAddProductForm() {
    document.getElementById('addProductForm').style.display = 'block';
}
</script>
<script>
function showEditProductForm() {
     document.getElementById('editProductForm').style.display = 'block';
	
}
</script>
<script>
function showAddProductForm() {
    document.getElementById('delProductForm').style.display = 'block';
}
</script>
</body>
</html>
