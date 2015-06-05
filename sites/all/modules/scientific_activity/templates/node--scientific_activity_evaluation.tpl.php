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
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

 
    



</div>


<?php $user = user_load($user->uid); ?>

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


if ($info) {
  $label = $info['label'];
}

print_r($label);
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
              $options = $wrapper->$fid->$points->optionsList();
              print '<p>&nbsp;</p>';
              foreach ($options as $op_id => $op_val) {
                print '<p>' . $op_val . '</p>';
              }
            ?>
          </td>
          <td>
            <?php
              $hint = $fid . '_hint';
              print $wrapper->$fid->$hint->value() ? $wrapper->$fid->$hint->value() : '';
            ?>
          </td>
          <td>
            <?php 
              $options = $wrapper->$fid->$points->optionsList();
              if ($wrapper->$fid->__isset($final_points)) {
                print '<p>' . $wrapper->$fid->$final_points->value() . '</p>';
              } else {
                print '<p>' . $options[$wrapper->$fid->$points->value()]  . '</p>'; 
              }
              
            ?>
          </td>
          <td>
              
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
      </table>
            
    
      
      
   
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



    <table border=1>
      <thead>
        <tr>
          <th>№ п/п</th>
          <th>Предмет оцінювання</th>
          <th>Вартісні бали</th>
          <th>Примітки</th>
          <th>К-ть балів</th>
          <th>Відмітка про перевірку</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1.</td>
          <td>Науковий ступінь доктор (кандидат) наук</td>
          <td>100 (50) балів</td>
          <td>За наявності диплома</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>2.</td>
          <td>Вчене звання професор (доцент)</td>
          <td>80 (40) балів</td>
          <td>За наявності атестата</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>3.</td>
          <td>Звання: «Заслужений»; майстер спорту</td>
          <td>70 балів 70 балів</td>
          <td>За наявності документа</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>4.</td>
          <td>Членство в державних академіях наук: академік; член-кореспондент</td>
          <td>200 балів 150 балів</td>
          <td>За наявності документа</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>5.</td>
          <td>Членство в зарубіжних академіях наук: академік; член-кореспондент</td>
          <td>200 балів 150 балів</td>
          <td>За наявності документа</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>6.</td>
          <td>Почесний ступінь (звання) зарубіжного університету: почесний доктор наук; почесний професор</td>
          <td>100 балів 100 балів</td>
          <td>За наявності документа</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>7.</td>
          <td>Індекс цитування h (за даними SCOPUS)</td>
          <td>30 балів</td>
          <td>h *Вартісний бал</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>8.</td>
          <td>Захищено під Вашим керівництвом дисертацій (загалом до звітного періоду): - докторських; - кандидатських</td>
          <td>100 балів 50 балів</td>
          <td>Кількість дисертацій*Вартісний бал</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>9.</td>
          <td>Захищено під Вашим керівництвом дисертацій за звітний період: докторських; кандидатських</td>
          <td>250 балів 150 балів</td>
          <td>Кількість дисертацій*Вартісний бал</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>10.</td>
          <td>Наявність незахищених (за 5 останніх років) випускників: докторантури; аспірантури</td>
          <td>– 30 балів – 15 балів</td>
          <td>Кількість осіб*Вартісний бал Боржником не є випускник: протягом 1 р. після випуску; який подав дис. до спецради</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>11.</td>
          <td>Керівництво: докторантами; аспірантами; здобувачами ступеня доктора наук (за наказом по ЧНУ); здобувачами ступеня кандидата наук (за наказом по ЧНУ)</td>
          <td>100 балів 50 балів 75 балів 40 балів</td>
          <td>Кількість осіб*Вартісний бал</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>12.</td>
          <td>Членство в: експертній раді ДАК; спеціалізованій вченій раді із захисту докторських дис.; спеціалізованій вченій раді із захисту кандидатських дис.</td>
          <td>100 балів 60 балів 50 балів</td>
          <td>Голові, заступнику голови, вченому секретарю – додатково 20 балів</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>13.</td>
          <td>Опонування дисертацій: докторських; кандидатських; за кордоном</td>
          <td>50 балів 30 балів + 20 балів</td>
          <td>Надати автореферат особи, яка захищалась</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>14.</td>
          <td>Рецензування дисертацій: докторських; кандидатських; із зарубіжжя</td>
          <td>40 балів 25 балів + 15 балів</td>
          <td>Надати витяг з протоколу або копію рецензії</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>15.</td>
          <td>Рецензування авторефератів дис.: докторських; кандидатських</td>
          <td>15 балів 10 балів</td>
          <td>Надати копію засвідченої рецензії</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>16.</td>
          <td>Захист дисертації: докторської; кандидатської</td>
          <td>500 балів 300 балів</td>
          <td>При достроковому захисті – вартісні бали *2</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>17.</td>
          <td>Дисертацію не захищено протягом двох років після: випуску з аспірантури; випуску з докторантури; перебування на посаді ст. наук. співробітника</td>
          <td>- 100 балів - 150 балів - 200 балів</td>
          <td>Боржником не є випускник: протягом 1 р. після випуску; - який подав дис. до спецради</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>18.</td>
          <td>Участь у НДР за темою: держбюджетною; договірною</td>
          <td>75 балів 500 балів</td>
          <td>Керівнику проекту – додатково 20 балів</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>19.</td>
          <td>Отримано грант, стипендію: міжнародну; державну; приватних фондів</td>
          <td>200 балів 150 балів 100 балів</td>
          <td>Керівнику проекту – додатково 20 балів</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>20.</td>
          <td>Публікації: книги; статті; тези і матеріали доповідей</td>
          <td>Кількість і загальна сума балів за окремим видом публікацій</td>
          <td>Надати окремий відбиток (титул, оборот титулу, зміст, службова сторінка) кожної публікації</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>21.</td>
          <td>Отримано у звітному році: патент; авторське свідоцтво</td>
          <td>200 балів 100 балів</td>
          <td>К-ть патентів (свідоцтв)* Вартісний бал</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>22.</td>
          <td>Рецензування: монографій та ін. наук. видань; підручників та ін. навч. видань; довідкових видань; статей у міжнародних виданнях; інших видань</td>
          <td>40 балів 30 балів 20 балів 15 балів 10 балів 5 балів</td>
          <td>Надати скорочений відбиток (титул, оборот титулу) кожної публікації, де Ви зазначені рецензентом</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>23.</td>
          <td>Членство в редколегіях наукових журналів, вісників, збірників: зарубіжних; українських академічних; українських фахових; інших</td>
          <td>30 балів 20 балів 10 балів</td>
          <td>Головному редактору, відп. редактору, відп. секретарю, відп. за випуск – додатково 30 балів</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>24.</td>
          <td>Членство в: НАК; експертній раді МОНУ; комісіях МОНУ; комісіях облдержадміністрації</td>
          <td>70 балів 60 балів 50 балів 40 балів</td>
          <td>Надати копію програми конференції</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>27.</td>
          <td>Організація наукових конкурсів, олімпіад: міжнародних; всеукраїнських; обласних; університетських. Участь у журі конкурсу, олімпіади</td>
          <td>25 балів 20 балів 15 балів 10 балів +5 балів</td>
          <td>Надати копію наказу</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>28.</td>
          <td>Керівництво студентською науковою роботою з підготовки: заявки на видачу охоронних документів; наукової статті; доповіді на конференцію, тези</td>
          <td>15 балів 10 балів 5 балів</td>
          <td>Надати копію статті із зазначенням прізвища або копію відгука керівника</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>29.</td>
          <td>Керівництво студентською науковою роботою з підготовки до наукового конкурсу За отримані премію, диплом, грамоту з державного чи приватних фондів (в т. ч. фонду Віктора Пінчука): міжнародного рівня; всеукраїнського рівня; регіонального рівня. Рецензування студентських наукових робіт</td>
          <td>20 балів за кожний вид роботи + 20 балів + 15 балів + 10 балів + 10 балів</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>30.</td>
          <td>Керівництво учнівськими науковими роботами (МАН). За отримані місця: всеукраїнського рівня; обласного рівня; районного рівня. Участь в журі конкурсу робіт МАН Рецензування робіт МАН</td>
          <td>15 балів за кожний вид роботи +10 балів +5 балів +5 балів 5 балів 5 балів</td>
          <td>Надати копію наказу Підтвердити документально</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>31.</td>
          <td>Підготовка студентів (школярів) до олімпіад. За отримані призові місця: міжнародних олімпіад; всеукраїнських олімпіад; регіональних олімпіад</td>
          <td>20 балів за кожного +40 (30) балів +30 (20) балів +20 (10) балів</td>
          <td>Надати копію розпорядження по інституту</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>32.</td>
          <td>Керування студентським науковим гуртком</td>
          <td>30 балів</td>
          <td>Протокол засідання кафедри</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>33.</td>
          <td>Постановка і проведення експерименту з оформленням звітної документації </td>
          <td>20 балів</td>
          <td>Підтвердити документально</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>34.</td>
          <td>Для специфічних категорій фахівців. Підготовка та проведення культурно-спортивних заходів (в т.ч. виставок): міжнародних; всеукраїнських; регіональних; університетських</td>
          <td>20 балів 15 балів 10 балів 5 балів</td>
          <td>Підтвердити документально</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>35.</td>
          <td>Керівництво науковим проектом, що здійснюється на громадських засадах за межами ЧНУ (в т.ч. розробка і читання лекцій для аспірантів і молодих науковців поза навчальним планом, розробка авторських програмних та інших продуктів; супровід програмного продукту)</td>
          <td>40 балів за кожний проект 80 балів за цикл робіт</td>
          <td>Підтвердити документально Довідка про впровадження</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>36.</td>
          <td>Участь в організації та проведенні конкурсу «Учитель року»: всеукраїнського туру; обласного туру; районного туру</td>
          <td>15 балів 10 балів 5 балів</td>
          <td>Підтвердити документально</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>37.</td>
          <td>Популяризація науки: виступи в ЗМІ, що містять результати наукової роботи; проведення майстер-класів; публікації в мережі Інтернет; керівництво організаціями творчих спілок та ін.</td>
          <td>15 балів за кожний вид роботи</td>
          <td>Підтвердити документально</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>38.</td>
          <td>Виконання обов’язків на громадських засадах: заступника директора (декана) ННІ (факультету) з наукової роботи; заступника завідувача кафедри; директора музею; члена президії Ради молодих учених; члена Ради молодих учених.</td>
          <td>15 балів 10 балів 10 балів 10 балів 5 балів</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="4">ЗАГАЛЬНА СУМА БАЛІВ</td>
          <td></td>
        </tr>
      </tbody>
    </table>

    <div>Особистий підпис </div>

    <div>Підпис завідувача кафедри</div>

    <div>Підпис директора ННІ (декана факультету) </div>

    <div><strong>УВАГА!</strong> У додатку 1 подаються 2 списки публікацій – окремо за I і II півріччя навчального року. В обох списках наводяться дані про рейтингову оцінку кожної публікації та сумарний бал. 
              У додатку 2 подаються паспорти опублікованих книг, що містять розрахунок рейтингової оцінки відповідної книги. </div>
    
  </div>

</div>

