<div class="container">
  <!-- Push Wrapper -->
  <div class="mp-pusher" id="mp-pusher">

    <!-- mp-menu -->
    <nav id="mp-menu" class="mp-menu">
    
      <div class="mp-level">
        <div class="utility-links-wrapper">
          <div class="utility-links-content">
            <div class="close-menu" id="mp-close-menu">X</div>
            <div class="utility-links">
              <?php 
                $menu_name = variable_get('menu-utility-bar', 'menu-utility-bar');
                $tree = menu_tree($menu_name);
                  print drupal_render($tree);
              ?>         
            </div>
          </div>
        </div>
        <ul id="mp-level-1">
          <?php foreach($variables['menu'] as $menu_item): ?>
            <?php if(isset($menu_item['children'])): ?>
              <li class="icon icon-arrow-left">
           <?php else: ?>
              <li>
            <?php endif; ?>
            <?php print $menu_item['link']; ?>
            <?php if(isset($menu_item['children']) && !empty($menu_item['children'])): ?>
              <div class="mp-level" id="mp-level-2">
                <div class="utility-links-wrapper">
                  <div class="utility-links-content">
                    <div class="close-menu" id="mp-close-menu">X</div>
                    <div class="utility-links">
                      <?php 
                        $menu_name = variable_get('menu-utility-bar', 'menu-utility-bar');
                        $tree = menu_tree($menu_name);
                        print drupal_render($tree);
                      ?>         
                    </div>
                  </div>
                </div>
                <a class="mp-back" href="#">Back</a>
                <ul id="mp-second-level">
                  <li>
                    <?php if(isset($menu_item['sub_heading']['link'])): ?>
                      <?php print $menu_item['sub_heading']['link']; ?>
                    <?php else: ?>
                      <?php print $menu_item['link']; ?>
                    <?php endif; ?>
                  </li>
                  <?php foreach($menu_item['children'] as $item): ?>
                    <li>
                      <?php print $item['link']; ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </nav>
    <!-- /mp-menu -->

        <div class="clearfix"></div>

  </div><!-- /pusher -->
</div><!-- /container -->
