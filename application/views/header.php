<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
			<?php echo anchor('', lang('website_title'), 'class="navbar-brand"'); ?>
        </div>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav" style="display: none">
            <li class="divider-vertical"></li>
            <li><?php echo anchor('', 'Nav Link 1'); ?></li>
            <li><?php echo anchor('', 'Nav Link 2'); ?></li>
        </ul>

        <ul class="nav navbar-nav" style="margin: 10px 0 10px 0;">
            <audio id="audio_player" src="<?php echo base_url().RES_DIR; ?>/media/Season_in_the_Sun.mp3" type="audio/mp3" controls="controls">
        </ul>
        <script>
            var player = new MediaElementPlayer('#audio_player');
            function play_audio($url) {
                player.pause();
                player.setSrc($url);
                player.play();
            }
        </script>
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a class="dropdown-toggle" id="player_list" role="button" data-toggle="dropdown" href="#">Player List <b class="caret"></b></a>
                <!-- see http://lab.hakim.se/scroll-effects/ fly-simplified cards  helix-->
                <ul id="player_list_menu" class="dropdown-menu helix" role="menu" aria-labelledby="player_list">
                    <?php
                    $media_base_path = getcwd().'/'.RES_DIR.'/media';
                    $media_base_url= RES_DIR.'/media/';
                    $sub_files = scandir($media_base_path);
                    foreach ($sub_files as $file) {
                        if ($file == '.' || $file == '..')
                            continue;
                        if (!is_dir($media_base_path . '/' . $file) && ( substr($file, -strlen('.mp3')) === '.mp3') ) {
                            $media_url = mb_convert_encoding($media_base_url.$file, "UTF-8", "gbk");
                            // Just get file name contains Chinese characters, pathinfo("")['filename'], basename($path,".php"), ... not work;
                            $file = mb_convert_encoding($file, "UTF-8", "gbk");
                            // <a href=\"javascript:void(0)\" onclick=\"play_audio(\"$media_url\"); return false;\">$file</a>
                            // anchor('javascript:void(0)', $file, "onclick=\"play_audio(\"$media_url\"); return false;\"")
                            echo '<li role="presentation">'."<a href=\"javascript:void(0)\" onclick='play_audio(\"$media_url\"); return false;'>$file</a>".'</li>';
                            //                                    echo '<li role="presentation">'.$file.'</li>';
                        }
                    }?>
                </ul>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php if ($this->authentication->is_signed_in()) : ?>
                    <i class="icon-user icon-white"></i> <?php echo $account->username; ?> <b class="caret"></b></a>
                <?php else : ?>
                    <i class="icon-user icon-white"></i> <b class="caret"></b></a>
                <?php endif; ?>

                <ul class="dropdown-menu">
                    <?php if ($this->authentication->is_signed_in()) : ?>
                        <li class="dropdown-header">Account Info</li>
                        <li><?php echo anchor('account/account_profile', lang('website_profile')); ?></li>
                        <li><?php echo anchor('account/account_settings', lang('website_account')); ?></li>
                        <?php if ($account->password) : ?>
                            <li><?php echo anchor('account/account_password', lang('website_password')); ?></li>
                        <?php endif; ?>
                        <li><?php echo anchor('account/account_linked', lang('website_linked')); ?></li>
                        <?php if ($this->authorization->is_permitted( array('retrieve_users', 'retrieve_roles', 'retrieve_permissions') )) : ?>
                            <li class="divider"></li>
                            <li class="dropdown-header">Admin Panel</li>
                            <?php if ($this->authorization->is_permitted('retrieve_users')) : ?>
                                <li><?php echo anchor('account/manage_users', lang('website_manage_users')); ?></li>
                            <?php endif; ?>

                            <?php if ($this->authorization->is_permitted('retrieve_roles')) : ?>
                                <li><?php echo anchor('account/manage_roles', lang('website_manage_roles')); ?></li>
                            <?php endif; ?>

                            <?php if ($this->authorization->is_permitted('retrieve_permissions')) : ?>
                                <li><?php echo anchor('account/manage_permissions', lang('website_manage_permissions')); ?></li>
                            <?php endif; ?>
                        <?php endif; ?>

                        <li class="divider"></li>

                        <li class="dropdown-header">Student Assistant</li>
                        <li><?php echo anchor('student_assistant/manage_schools', lang('website_manage_schools')); ?></li>
                        <li><?php echo anchor('student_assistant/manage_institutes', lang('website_manage_institutes')); ?></li>
                        <li><?php echo anchor('student_assistant/manage_rooms', lang('website_manage_rooms')); ?></li>
                        <li><?php echo anchor('student_assistant/manage_course_types', lang('website_manage_course_types')); ?></li>
                        <!--
                                <li><?php echo anchor('student_assistant/manage_teachers', lang('website_manage_teachers')); ?></li>
                                <li><?php echo anchor('student_assistant/manage_students', lang('website_manage_students')); ?></li>
                                <li><?php echo anchor('student_assistant/manage_courses', lang('website_manage_courses')); ?></li>
                                <li><?php echo anchor('student_assistant/manage_lessons', lang('website_manage_lessons')); ?></li>
                                <li><?php echo anchor('student_assistant/manage_curriculums', lang('website_manage_curriculums')); ?></li>
                                <li><?php echo anchor('student_assistant/manage_schedule_times', lang('website_manage_schedule_times')); ?></li>
                                <li><?php echo anchor('student_assistant/manage_schedule_times', lang('website_manage_schedule_times')); ?></li>
                                -->

                        <li class="divider"></li>
                        <li><?php echo anchor('account/sign_out', lang('website_sign_out')); ?></li>
                    <?php else : ?>
                        <li><?php echo anchor('account/sign_in', lang('website_sign_in')); ?></li>
                    <?php endif; ?>

                </ul>
            </li>
        </ul>
        </div>
    </div>
    <!--/.navbar-collapse -->
</div>
