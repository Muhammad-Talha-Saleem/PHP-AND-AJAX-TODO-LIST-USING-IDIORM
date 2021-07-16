<?php 
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<!-- HEAD -->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=us-ascii" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <title>Todo</title>
  <link rel="stylesheet" href="style.css" type="text/css" />
  <!-- Styling -->
  <style>
   input[type="color"]{
    opacity: 0;
  }
  #main {
    position: absolute;
  }
  .process {
    background: url('https://media0.giphy.com/media/3oEjI6SIIHBdRxXI40/200.gif') no-reapet right;
    background-size: contain;
  }
  .hide {
    display: none;
    position: absolute;
  }
  .span{
    position: relative;left: 2px;
    border-radius: 5px;
    font-size: 5px;

  }

  #div3 {
    color: #0f5132;
    height: 30px;
    border-radius: 5px;
    line-height: 30px;
    margin-right: 30px !important;
    padding: 10px;
    width: 100%;
    color: #842029;
    background-color: #f8d7da;
    border-color: #f5c2c7;
  }
  .line-through {
    text-decoration: line-through;
  }
</style>
</head>
<!-- BODY -->
<body>
  <div id="page-wrap">
    <div id="header">
      <h1><a href="">PHP Sample Test App</a></h1>
    </div>
    <div id="main">
      <noscript>This site just doesn't work, period, without JavaScript</noscript>

      <div id="div3" class="hide">Delete Sucessfully!</div>
      <ul class="ui-sortable" id="list" style="position:relative;top:10px;">
        <?php
                                // SQL IDIORM QUERY
        $name = ORM::for_table('listitems')->order_by_asc('orderID')->find_many();
        foreach ($name as $nam) {
          ?>
          <!-- LIST -->
          <li data-post-id="<?php echo $nam->id; ?>" color="1" class="colorBlue" rel="<?php echo $nam->id; ?>">
            <div class="li-post-group">

              <input type="text" id="color<?php echo $nam->id?>" class="span" onclick="changeColor()" style="background-color: <?php echo $nam->color ?>;border-color:white;width: 95%;position: relative;height: 10px;font-size: 15px;" value="<?php echo $nam->name ?>"
              onBlur="updateValue(this,'name','<?php echo $nam->id ?>')">
              <div id="post<?php echo $nam->id; ?>" class='draggertab tab handle'></div>
              
              <!-- COLOR TAB -->
              <div  class='colortab tab'>
                <input type="color" class="bg"  data-id="<?php echo $nam->id?>">
              </div>

              <!-- DELETE BUTTON -->
              <?php echo "<a href='delete.php?id=$nam->id&name=$nam->name&detail=$nam->orderID'  class='delete'>"; ?>
              <div class='deletetab tab'>
                <a id="BtnDelete<?php echo $nam->id?>" style="border-bottom: none;"
                  onclick="TestingFunc('<?php echo $nam->id?>','1','0')">
                  <img src="images/final.png" alt=""> </a>

                  <a href='delete.php?id=<?php echo $nam->id?>'  class="ShowHide<?php echo $nam->id?>" id="BtnSure<?php echo $nam->id?>" 
                    style="display: none;border-bottom: none;float:left" 
                    onclick="TestingFunc('<?php echo $nam->id?>','1','1')">
                    <img src="images/d.png" alt="" onclick="Second()"></a>

                    <button type="button" class="ShowHide<?php echo $nam->id?>" id="BtnCancel<?php echo $nam->id?>" style="display: none;" 
                      onclick="TestingFunc('<?php echo $nam->id?>','2','0')">
                    Cancel</button>
                  </div>
                  <?php echo "</a>"; ?>
                                                       <!-- DONE BUTTON -->
                  <div class="donetab tab" id="striker<?php echo $nam->id?>" onclick="LineFunc('<?php echo $nam->id?>')"></div>

                </div>
              </li>
              <?php
            }
            ?>
          </ul>

          <br />
          <!-- FORM -->
          <form action="insert.php" id="add-new" method="post">
            <input type="text" id="new-list-item-text" name="name" required="" />
            <input type="submit" name="submit" id="add-new-submit" value="Add" class="button" />
          </form>

          <div class="clear"></div>
        </div>
      </div>
      <!-- JQUERY -->      
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
      
      <!-- <script src="jquery.js"></script> -->


      <script>
                        // Double-click Delete button
                        function TestingFunc(Row,Condition,Delete)
                        {   
                          if(Condition == 1)
                          {
                            $('#BtnDelete'+Row).css('display','none');
                            $('.ShowHide'+Row).css('display','block');  
                            if(Delete == 1)
                            {

                            }
                          }
                          else
                          {
                           $('#BtnDelete'+Row).css('display','block');
                           $('.ShowHide'+Row).css('display','none');   
                         }

                       };

                        // DONE TAB
                        function LineFunc(id)
                       {   
                        console.log(document.getElementById(id));
                        console.log($(id).parent());
                        console.log($(id).parent().closest('li'));
                        console.log($(id).parent().closest('li').find('input.span'));
                        //$(document.getElementById(id)).parent().closest('li').find('input.span').css('text-decoration','line-through');
                        if($('#color'+id).hasClass('line-through')) {
                          $('#color'+id).removeClass('line-through');
                        } else {
                          $('#color'+id).addClass('line-through');
                        }

                       };

            // Delete Popup
          function Second() {

            var div3 = document.getElementById("div3");
            div3.className = "show";

            $('#div3').fadeOut(5000);

          };

        // update
        function updateValue(element, column, id) {
          var value = element.value;
          $(element).attr('class', 'process')
          $.ajax({
            url: "edit.php",
            method: "post",
            data: {
              value: value,
              column: column,
              id: id
            },
            success: function (php_result) {
              console.log(php_result);
            }
          });
        };

      // SORTABLE
      $(document).ready(function(){
          // SORTABLE
          $( "#list" ).sortable({
            handle: ".handle",
            placeholder : "ui-state-highlight",
            update  : function(event, ui)
            {
              var post_order_ids = new Array();
              $('#list li').each(function(){
                post_order_ids.push($(this).data("post-id"));


              });
              $.ajax({
                url:"ajax_upload.php",
                method:"POST",
                data:{post_order_ids:post_order_ids},
                success:function(data)
                {
                  console.log(data)
                  if(data)
                  {
                    $(".alert-danger").hide();
                    $(".alert-success ").show();
                  }
                  else
                  {
                    $(".alert-success").hide();
                    $(".alert-danger").show();
                  }
                }
              });
            }
          });

          // COLOR change
          $(".bg").change(function(){
            var id = $(this).attr('data-id');
            console.log(id);
            var color = $(this).val();
            console.log(color);
            $("#color"+id).css("background-color", color);
            $.ajax({
              url:"color_update.php",
              method:"POST",
              data:{id:id,color:color},
              success:function(data)
              {
                console.log(data)
                if(data)
                {
                  $(".alert-danger").hide();
                  $(".alert-success ").show();
                }
                else
                {
                  $(".alert-success").hide();
                  $(".alert-danger").show();
                }
              }
            });
          });

          $("#striker").click(function(){
            $(this).closest("li").addClass("checked");
          });

        });

    
    
      </script>
    </body>

    </html>