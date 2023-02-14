<?php
//include files
require_once("include/dbcon.inc.php");
require_once("ui/navbar.ui.php");
require_once("ui/footer.ui.php");
require_once("include/combo.inc.php");
require_once("ui/spilit_result.ui.php");
require_once("include/redirect.inc.php");
require_once("ui/jsAlert.ui.php");
require_once("include/loginverify.inc.php");

$JSAlertMessage=null;
if(isset($_GET["msg"])){
	$JSAlertMessage=resolveURLmsg($_GET["msg"]);
}

loginVerify("search");


//search materials
	$page=1;
	$search_result=null;
	$search_result_data=array();
	$txtSearch="";
	$data_get_success=0;
	$ddlCategory=null;

	//get search infomation from address bar when using page navigator
	if(isset($_GET["search_info"])){
		$search_info=$_GET["search_info"];
		$search_info=unserialize(base64_decode($_GET["search_info"]));
		$data_get_success=1;

		$page=$search_info[0];
		$ddlCategory=$search_info[1];
		$txtSearch=$search_info[2];
	}

	//get search details from post(search buttion clicking)
	if(isset($_POST["btnSearch"])){
		$txtSearch=$_POST["txtSearch"];
		$ddlCategory=$_POST["ddlCategory"];
	}

	if((isset($_POST["btnSearch"]))||$data_get_success==1){
		$sql_quary="";
		$search_param=$txtSearch;

		$sql_quary="SELECT * FROM item LEFT JOIN (SELECT * FROM item_image GROUP BY item_image_item_id) AS tbl_one_image ON item.`item_ID` = tbl_one_image.`item_image_item_id` WHERE `Item_Title` LIKE :item_name ORDER BY Post_Date";
		$search_param="%".$txtSearch."%";
		$query_params=array(":item_name"=>$search_param);
			
		$search_result=spilit_result($page,5,$sql_quary,$query_params);
		//print_r($search_result);

		$search_result_data=$search_result[0];
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>NearBuy - Search</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Contact-FormModal-Contact-Form-with-Google-Map.css">
    <link rel="stylesheet" href="assets/css/dh-row-titile-text-image-right-1.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Multi-step-form.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo-1.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/Search-Input-Responsive-with-Icon.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <style type="text/css">
    	.selected-pager{
		    background-color:#c5c5c5;
		}
		.side-margin{
			margin:0px 10px;
		}
		a, a:hover, a:focus, a:active {
		     text-decoration: none;
		     color: inherit;
		}
    </style>
</head>
<body>
	<?php showNavBar("search"); // navigation bar ?>

    <div id="empresa-1" style="padding:20px;margin:1px;width: 100%;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card m-auto">
                        <div class="card-body">
                           	<form class="d-flex align-items-center" role="form" action="search.php" method="post">
                               	<?php
					            $c_sql="SELECT * FROM itemcategory;";
					            $class="form-select form-select-lg flex-shrink-1 form-control-borderless side-margin";
					            dbCombo($c_sql,"ddlCategory","Categort_ID","Category_Name",$ddlCategory,$c_required=true,$class);
       							 ?>
                                
                                <input type="search" name="txtSearch" id="txtSearch" class="form-control form-control-lg flex-shrink-1 form-control-borderless side-margin" value="<?php echo $txtSearch; ?>" placeholder="Enter Search Text" autofocus/>
                                <button class="btn btn-warning btn-lg side-margin" type="submit"  name="btnSearch" id="btnSearch" >Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card m-auto">
                        <div class="card-body">
                        	<div class="row">
                        		<div class="col-sm-6 col-md-6 col-lg-6 mx-auto">
			<?php
			$search_info_arr=array($page,$ddlCategory,$txtSearch);
        	$search_info_arr_str=base64_encode(serialize($search_info_arr));
        	$urlBack="search.php?search_info=".$search_info_arr_str;
        	$url = encyptMsgURL("viewItem.php",$urlBack,"urlBack");
				if(count($search_result_data)>0){
					echo "<h4>Search Results</h4>";
					foreach ($search_result_data as $row){
						$url = encyptMsgURL($url,$row["Item_ID"],"item",true);
			?>
						<a href="<?php echo $url; ?>">
						<div class="card bg-light border-primary mb-3">
                            <div class="card-header">
                                <h5 class="card-title"><?php echo $row["Item_Title"]; ?></h5>
                                <small class="text-muted">Posted at <?php echo $row["Post_Date"]; ?></small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="<?php echo $row["item_image"]; ?>" width="100%"/>
                                    </div>
                                    <div class="col-sm-8">
                                        <p class="card-text"><?php echo $row["Description"]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    	</a>
            <?php
					}

					echo "<div class=\"container\" style=\"width:100%;\"><div class=\"row\"><div class=\"col-sm-3 col-md-3 col-lg-3 mx-auto\"><ul class=\"pagination\">";
					$page_range=page_range(2,$search_result[1],$page);
					for ($i=$page_range[0]; $i<=$page_range[1]; $i++) {
        				if ($i==$page){
        					echo "<li class=\"page-item\"><a class=\"page-link selected-pager\" href=\"#\">".$i."</a></li>";
        				}
        				else{
        					$search_info_arr=array($i,$ddlCategory,$txtSearch);
        					$search_info_arr_str=base64_encode(serialize($search_info_arr));
        					echo "<li class=\"page-item\"><a  class=\"page-link\" href=\"search.php?search_info=".$search_info_arr_str."\">".$i."</a></li>";
        				}
            		}
            		echo "</ul></div></div></div>";
        		}
        		else{
        			if((isset($_POST["btnSearch"]))||$data_get_success==1){
						echo "<div style=\"width:100%; padding:10px;\"><h3>No Results!</h3><p>There is no any result for your search.</p></div>";
					}
					else{
						echo "<div style=\"width:100%; padding:10px;min-height:200px;\"><h3>Looking for someting?</h3><p>Select category, type a keyword and click search!</p></div>";
					}
				}
  			?>
  						</div>
  						</div>
  	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        showFooter();  //footer 
        showAlert($JSAlertMessage);
    ?>
    <!--- UI JS stuff --->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/Contact-FormModal-Contact-Form-with-Google-Map.js"></script>
    <script src="assets/js/Multi-step-form.js"></script>
</body>
</html>