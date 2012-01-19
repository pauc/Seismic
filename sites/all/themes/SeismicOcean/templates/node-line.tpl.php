<?php
/**
 * @file
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $display_submitted: whether submission information should be displayed.
 * - $submitted: Themed submission information output from
 *   theme_node_submitted().
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 *   The following applies only to viewers who are registered users:
 *   - node-by-viewer: Node is authored by the user currently viewing the page.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $build_mode: Build mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $build_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * The following variable is deprecated and will be removed in Drupal 7:
 * - $picture: This variable has been renamed $user_picture in Drupal 7.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see zen_preprocess()
 * @see zen_preprocess_node()
 * @see zen_process()
 */
?>
<?php
  drupal_add_js(drupal_get_path('theme', 'SeismicOcean') .'/js/col-expand-map-menu.js', 'theme');
?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix">
  <?php print $user_picture; ?>

  <?php if (!$page && $title): ?>
    <h2 class="title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>

  <?php if ($unpublished): ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>

  <?php if ($display_submitted || $terms): ?>
    <div class="meta">
      <?php if ($display_submitted): ?>
        <span class="submitted">
          <?php print $submitted; ?>
        </span>
      <?php endif; ?>

      <?php if ($terms): ?>
        <div class="terms terms-inline"><?php print $terms; ?></div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="content">
    <?php //print $content; ?>
    <?php if(!$teaser): ?>
      <div id="map">
        <?php print views_embed_view('lines', 'page_3', $nid); ?>
        <div id="advert">
          (*) Contains oceanographic profile
        </div>
      </div>
      <div id="map-menu">
      <?php
          $block = (object) module_invoke('menu_block', 'block', 'view', 1);
          $block->subject = "Map levels";
          print theme('block', $block);
      ?>      
      </div>
      <div id="line-profiles">
        <div id="seismic-profile" class="clearfix">
          <div class="profile-header">
            <?php print $node->content['field_line_parent_survey']['field']['#title']; ?>
            <?php print $field_line_parent_survey[0]['value']; ?>
            <span>
              <?php print $type . " " . $title; ?>
            </span>
            <span>
              Seismic profile:
            </span>
          </div>
          <div class="profile-img">
            <?php print $field_image[0]['view']; ?>
          </div>
          <div class="profile-data clearfix">
            <div class="col-1 col">
              <div class="field clearfix">
                <span class="field-label">
                  Start of line:
                </span>
                <span class="field-data">
                  <?php print $field_sol_lon_field[0]['value'] . " " . $field_sol_lat_field[0]['value']; ?>
                </span>
              </div>
              <div class="field clearfix">
                <span class="field-label">
                  End of line:
                </span>
                <span class="field-data">
                  <?php print $field_eol_lon_field[0]['value'] . " " . $field_eol_lat_field[0]['value']; ?>
                </span>
              </div>
              <div class="field clearfix">
                <span class="field-label">
                  <?php print $node->content['field_line_dates']['field']['#title']; ?>:
                </span>
                <span class="field-data">
                  <?php print $field_line_dates[0]['view']; ?>
                </span>
              </div>
              <div class="field clearfix">
                <span class="field-label">
                  <?php print $node->content['field_line_parent_zone']['field']['#title']; ?>:
                </span>
                <span class="field-data">
                  <?php print $field_line_parent_zone[0]['view']; ?>
                </span>
              </div>
              <div class="field clearfix">
                <span class="field-label">
                  <?php print $node->content['field_line_parent_survey']['field']['#title']; ?>:
                </span>
                <span class="field-data">
                  <?php print $field_line_parent_survey[0]['view']; ?>
                </span>
              </div>
            </div>
            <div class="col-2 col">
              <div class="field clearfix">
                <span class="field-label">
                  <?php print $node->content['field_line_acquisition_system']['field']['#title']; ?>:
                </span>
                <span class="field-data">
                  <?php print $field_line_acquisition_system[0]['view']; ?>
                </span>
              </div>
              <div class="field clearfix">
                <span class="field-label">
                  <?php print $node->content['field_line_streamer_lenght']['field']['#title']; ?>:
                </span>
                <span class="field-data">
                  <?php print $field_line_streamer_lenght[0]['view']; ?>
                </span>
              </div>
              <div class="field clearfix">
                <span class="field-label">
                  <?php print $node->content['field_line_type_of_processing']['field']['#title']; ?>:
                </span>
                <span class="field-data">
                  <?php print $field_line_type_of_processing[0]['view']; ?>
                </span>
              </div>
              <div class="field clearfix">
                <span class="field-label">
                  <?php print $node->content['field_line_used_source']['field']['#title']; ?>:
                </span>
                <span class="field-data">
                  <?php print $field_line_used_source[0]['view']; ?>
                </span>
              </div>
              <div class="field clearfix">
                <span class="field-label">
                  <?php print $node->content['field_number_of_chanels']['field']['#title']; ?>:
                </span>
                <span class="field-data">
                  <?php print $field_number_of_chanels[0]['view']; ?>
                </span>
              </div>
              <div class="field clearfix">
                <span class="field-label">
                  <?php print $node->content['field_line_shot_interval']['field']['#title']; ?>:
                </span>
                <span class="field-data">
                  <?php print $field_line_shot_interval[0]['view']; ?>
                </span>
              </div>
            </div>
          </div>
          <a href="#content" class="up">Back to map</a>
        </div>
        <?php if (isset($node->field_line_ocean_prof_image[0]["filename"])): ?>
          <div id="oceanographic-profile" class="clearfix">
            <div class="profile-header">
              <?php print $node->content['field_line_parent_survey']['field']['#title']; ?>
              <?php print $field_line_parent_survey[0][value]; ?>
              <span>
                <?php print $type . " " . $title; ?>
              </span>
              <span>
                Oceanogaphic profile:
              </span>
            </div>
            <div class="profile-img">
              <?php print $field_line_ocean_prof_image[0]['view']; ?>
            </div>
            <div class="profile-data clearfix">
              <div class="col-1 col">
                <div class="field clearfix">
                  <span class="field-label">
                    Start of line:
                  </span>
                  <span class="field-data">
                    <?php print $field_line_start_ocean_lon[0]['value'] . " " . $field_line_start_ocean_lat[0]['value']; ?>
                  </span>
                </div>
                <div class="field clearfix">
                  <span class="field-label">
                    End of line:
                  </span>
                  <span class="field-data">
                    <?php print $field_line_end_ocean_lon[0]['value'] . " " . $field_line_end_ocean_lat[0]['value']; ?>
                  </span>
                </div>
                <div class="field clearfix">
                  <span class="field-label">
                    Profiler
                  </span>
                  <span class="field-data">
                    <?php print $field_line_profiler[0]['view']; ?>
                  </span>
                </div>
                <div class="field clearfix">
                  <span class="field-label">
                    Number of profilers:
                  </span>
                  <span class="field-data">
                    <?php print $field_number_of_profilers[0]['view']; ?>
                  </span>
                </div>
                <div class="field clearfix">
                  <span class="field-label">
                    Profiler Interval:
                  </span>
                  <span class="field-data">
                    <?php print $field_line_profiler_interval[0]['view']; ?>
                  </span>
                </div>
              </div>
            </div>
            <a href="#content" class="up">Back to map</a>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>

  <?php print $links; ?>
</div><!-- /.node -->
