<aside class="left-sidebar sidebar-dark" id="left-sidebar">
  <div id="sidebar" class="sidebar sidebar-with-footer">
    <!-- Aplication Brand -->
    <div class="app-brand">
      <a href="index.php">
        <img src="../images/support.png" alt="Mono">
        <span class="brand-name"> DSL Sale</span>
      </a>
    </div>
    <!-- begin sidebar scrollbar -->
    <div class="sidebar-left" data-simplebar style="height: 100%;">
      <!-- sidebar menu -->
      <ul class="nav sidebar-inner" id="sidebar-menu">
        <?php


        $stmt = $conn->prepare(" 
        SELECT distinct a.header_title_id,header_title_name 
        FROM tbl_header_title a
        left join tbl_role_use_page b on a.header_title_id = b.header_title_id
        where role_id ='$role_id'
        order by  a.header_title_id asc ");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $header_title_id = $row['header_title_id'];
            $header_title_name = $row['header_title_name'];
        ?>

            <li class="section-title"> <?php echo "$header_title_name"; ?></li>


            <?php

            $stmt1 = $conn->prepare("
            SELECT distinct a.sub_header_id,sub_header_name,role_id,icon_code
            FROM tbl_sub_header a
            left join tbl_role_use_page b on a.sub_header_id = b.sub_header_id  
            where a.header_title_id = '$header_title_id' and role_id ='$role_id'
            order by a.sub_header_id asc   ");
            $stmt1->execute();
            if ($stmt1->rowCount() > 0) {
              while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {

                $sub_header_name = $row1['sub_header_name'];
                $sub_header_id = $row1['sub_header_id'];
                $icon_code = $row1['icon_code'];



            ?>
                <li class='has-sub <?php if ($header_click == "$sub_header_id") {
                                      echo "active expand";
                                    } ?>'>
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target='#<?php echo "$sub_header_name"; ?>' aria-expanded="false" aria-controls="<?php echo "$st_name"; ?>">
                    <i class="mdi <?php echo "$icon_code"; ?>"></i>
                    <span class="nav-text"> <?php echo "$sub_header_name"; ?> </span> <b class="caret"></b>
                  </a>

                  <ul class='collapse <?php if ($header_click == "$sub_header_id") {
                                        echo "show";
                                      } ?>' id="<?php echo "$sub_header_name"; ?>" data-parent="#sidebar-menu">
                    <div class="sub-menu">

                      <?php

                      $stmt2 = $conn->prepare(" 
                      SELECT page_title_name,page_title_file_name
                      FROM tbl_page_title a
                      left join tbl_role_use_page b on a.page_title_id = b.page_title_id 
                      where a.sub_header_id = '$sub_header_id' and role_id ='$role_id'
                      order by a.page_title_id asc ");
                      $stmt2->execute();
                      if ($stmt2->rowCount() > 0) {
                        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {

                          $page_title_name = $row2['page_title_name'];
                      ?>


                          <li class="<?php if ($header_name ==  $row2['page_title_name']) {
                                        echo "active";
                                      } ?>">
                            <a class="sidenav-item-link" href='<?php echo $row2['page_title_file_name'] ?>'>
                              <span class="nav-text"><?php echo "$page_title_name"; ?></span>

                            </a>
                          </li>

                      <?php
                        }
                      }


                      ?>






                    </div>
                  </ul>

              <?php

              }
            }

              ?>




                </li>


            <?php
          }
        }
            ?>







      </ul>

    </div>


  </div>
</aside>