<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
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
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
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
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
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
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<style>
    .dodatok {
        
    }
    .document-title {
        text-align: center;
        font-style: italic; 
    }
    .pib {
        text-align: center;
        text-decoration: underline;
        
    }
</style>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

 
    



</div>


<?php $user = user_load($user->uid); ?>


<div class="dodatok">Додаток А</div>

    <div class="document-title">ОЦІНКА НАУКОВОЇ ДІЯЛЬНОСТІ</div>

    <div class="pib"><?php print render($user->field_full_name[LANGUAGE_NONE][0]['value']); ?></div>

    <div class="hint">(Прізвище, ім’я, по батькові)</div>

    <div>
      <?php
        if (!empty($user->field_academic_status[LANGUAGE_NONE][0])) {
          print render($user->field_academic_status[LANGUAGE_NONE][0]['value']);
        }
      ?>
      кафедри
      <?php
        if (!empty($user->field_cathedra[LANGUAGE_NONE][0])) {
          if (!empty($user->field_cathedra[LANGUAGE_NONE][0]['value'])) {
            print render($user->field_cathedra[LANGUAGE_NONE][0]['value']);
          }
        }
        if (!empty($user->field_wage_rate[LANGUAGE_NONE][0])) {
          if (!empty($user->field_wage_rate[LANGUAGE_NONE][0]['value'])) {
            print render($user->field_wage_rate[LANGUAGE_NONE][0]['value']);
          }
        }
      ?>
      
    </div>

    <div>
      <?php
        if (!empty($user->field_nni_name[LANGUAGE_NONE][0])) {
          if (!empty($user->field_nni_name[LANGUAGE_NONE][0]['value'])) {
            print render($user->field_nni_name[LANGUAGE_NONE][0]['value']);
          }
        }
      ?>
    </div>

    <div class="hint">назва ННІ (факультету)</div>

    <div>за період 01.06.2013 – 31.05.2014 р.р.</div>


<div id="node-<?php print $node->nid; ?>" class="pdf <?php print $classes; ?> clearfix"<?php print $attributes; ?>>


  <div class="content"<?php print $content_attributes; ?>>
      
    <?php $wrapper = entity_metadata_wrapper('node', $node); ?>
      
      <table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
      <tbody>
        <tr>
          <td>№ п/п</td>
          <td>Предмет оцінювання</td>
          <td>Вартісні бали</td>
          <td>Примітки</td>
          <td>К-ть балів</td>
          <td>Відмітка про перевірку</td>
        </tr>
        <?php $i = 0; ?>
        <?php foreach ($fields as $fid => $fval): ?>
        <tr>
          <td>
            <?php print ++$i . '.'; ?>
          </td>
          <td>
            <?php

$bundle_name = 'field_diss_b'; // Field name the collection is attached to
$field_name = 'field_diss_b_multi_doc'; // Field name within the field collection


if (isset($info)) {
  $label = $info['label'];
}

              print '<p>' . $wrapper->$fid->label() . '</p>';
              $points = $fid . '_points';
              if ($wrapper->$fid->__isset($points)) {
                $multi = $wrapper->$fid->$points->optionsList();
                if (!empty($multi)) {
                  $final_points_val = 0;
                  foreach ($multi as $mkey => $mval) {
                    $multifield = $fid . '_multi_' . $mkey;
                    $final_points = $fid . '_points_f';
                    if ($wrapper->$fid->__isset($multifield)) {
                      $info = field_info_instance('field_collection_item', $multifield, $fid);
                      print '<p> - ' . $info['label'] . '</p>';
                    }
                  }
                  
                }
              }
              $variants = $fid . '_variants';
              if ($wrapper->$fid->__isset($variants)) {
                $options = $wrapper->$fid->$variants->optionsList();
                foreach ($options as $op_id => $op_val) {
                  print '<p> - ' . $op_val . '</p>';
                }
              }
            ?>
          </td>
          <td>
            <?php
              $points = $fid . '_points';
              if ($wrapper->$fid->__isset($points)) {
                $options = $wrapper->$fid->$points->optionsList();
                if (!empty($options)) {
                  print '<p>&nbsp;</p>';
                  foreach ($options as $op_id => $op_val) {
                    print '<p>' . $op_val . '</p>';
                  }
                }
              }
            ?>
          </td>
          <td>
            <?php
              $hint = $fid . '_hint';
              if ($wrapper->$fid->__isset($hint)) {
                if ($wrapper->$fid->$hint->value() != '') {
                  print $wrapper->$fid->$hint->value();
                }
              }
            ?>
          </td>
          <td>
            <?php
              if ($wrapper->$fid->__isset($final_points)) {
                print '<p>' . $wrapper->$fid->$final_points->value() . '</p>';
              } 
              if ($wrapper->$fid->__isset($points)) {
                $options = $wrapper->$fid->$points->optionsList();
                $val = $wrapper->$fid->$points->value();
                if (isset($options[$val])) {
                  print '<p>' . $options[$val]  . '</p>';
                }
              }
            ?>
          </td>
          <td>
              
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
      </table>
            


    <div>Особистий підпис </div>

    <div>Підпис завідувача кафедри</div>

    <div>Підпис директора ННІ (декана факультету) </div>

    <div><strong>УВАГА!</strong> У додатку 1 подаються 2 списки публікацій – окремо за I і II півріччя навчального року. В обох списках наводяться дані про рейтингову оцінку кожної публікації та сумарний бал. 
              У додатку 2 подаються паспорти опублікованих книг, що містять розрахунок рейтингової оцінки відповідної книги. </div>
    
  </div>

</div>

