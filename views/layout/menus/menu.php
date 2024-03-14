<?php
              $folder="views/layout/menus";

              include "{$folder}/dashboard_menu.php";

              foreach (glob("{$folder}/*_menu.php") as $filename)
              {
                if("{$folder}/dashboard_menu.php"==$filename)continue;
                  include $filename;
              }
          
          ?>