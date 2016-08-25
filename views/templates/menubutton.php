        

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo array_shift($value)?>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
          <?php          
          foreach ($value as $value1) {
            print "<li><a href=\"#\">$value1</a></li>";
          }
          unset($value1);
          ?>
          </ul>
        </li>