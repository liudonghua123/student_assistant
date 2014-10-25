<ul class="nav nav-pills nav-stacked">
  <li class="nav-header"><a>Account Info</a></li>
  <li class="<?php echo ($current == 'account_profile') ? 'active' : ''; ?>"><?php echo anchor('account/account_profile', lang('website_profile')); ?></li>
  
  <li class="<?php echo ($current == 'account_settings') ? 'active' : ''; ?>"><?php echo anchor('account/account_settings', lang('website_account')); ?></li>
  
  <?php if ($account->password) : ?>
    <li class="<?php echo ($current == 'account_password') ? 'active' : ''; ?>"><?php echo anchor('account/account_password', lang('website_password')); ?></li>
  <?php endif; ?>
  
  <li class="<?php echo ($current == 'account_linked') ? 'active' : ''; ?>"><?php echo anchor('account/account_linked', lang('website_linked')); ?></li>

  <?php if ($this->authorization->is_permitted( array('retrieve_users', 'retrieve_roles', 'retrieve_permissions') )) : ?>
    <li class="nav-header"><a>Admin Panel</a></li>
    <?php if ($this->authorization->is_permitted('retrieve_users')) : ?>
      <li class="<?php echo ($current == 'manage_users') ? 'active' : ''; ?>"><?php echo anchor('account/manage_users', lang('website_manage_users')); ?></li>
    <?php endif; ?>

    <?php if ($this->authorization->is_permitted('retrieve_roles')) : ?>
      <li class="<?php echo ($current == 'manage_roles') ? 'active' : ''; ?>"><?php echo anchor('account/manage_roles', lang('website_manage_roles')); ?></li>
    <?php endif; ?>

    <?php if ($this->authorization->is_permitted('retrieve_permissions')) : ?>
      <li class="<?php echo ($current == 'manage_permissions') ? 'active' : ''; ?>"><?php echo anchor('account/manage_permissions', lang('website_manage_permissions')); ?></li>
    <?php endif; ?>
    <li class="divider"></li>
    <li class="nav-header"><a>Student Assistant</a></li>
    <li class="<?php echo ($current == 'manage_schools') ? 'active' : ''; ?>"><?php echo anchor('student_assistant/manage_schools', lang('website_manage_schools')); ?></li>
    <li class="<?php echo ($current == 'manage_institutes') ? 'active' : ''; ?>"><?php echo anchor('student_assistant/manage_institutes', lang('website_manage_institutes')); ?></li>
    <li class="<?php echo ($current == 'manage_rooms') ? 'active' : ''; ?>"><?php echo anchor('student_assistant/manage_rooms', lang('website_manage_rooms')); ?></li>
    <li class="<?php echo ($current == 'manage_course_types') ? 'active' : ''; ?>"><?php echo anchor('student_assistant/manage_course_types', lang('website_manage_course_types')); ?></li>
    <!--
    <li class="<?php echo ($current == 'manage_teachers') ? 'active' : ''; ?>"><?php echo anchor('student_assistant/manage_teachers', lang('website_manage_teachers')); ?></li>
    <li class="<?php echo ($current == 'manage_students') ? 'active' : ''; ?>"><?php echo anchor('student_assistant/manage_students', lang('website_manage_students')); ?></li>
    <li class="<?php echo ($current == 'manage_courses') ? 'active' : ''; ?>"><?php echo anchor('student_assistant/manage_courses', lang('website_manage_courses')); ?></li>
    <li class="<?php echo ($current == 'manage_curriculums') ? 'active' : ''; ?>"><?php echo anchor('student_assistant/manage_curriculums', lang('website_manage_curriculums')); ?></li>
    <li class="<?php echo ($current == 'manage_schedule_times') ? 'active' : ''; ?>"><?php echo anchor('student_assistant/manage_schedule_times', lang('website_manage_schedule_times')); ?></li>
    -->
  <?php endif; ?>

</ul>