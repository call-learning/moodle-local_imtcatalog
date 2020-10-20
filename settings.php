<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This file defines settingpages and externalpages under the "courses" category
 *
 * @package    local_resourcelibrary
 * @copyright  2020 CALL Learning 2020 - Laurent David laurent@call-learning.fr
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;
if ($hassiteconfig) {
    $settings = new admin_category('resourcelibrary', get_string('pluginname', 'local_resourcelibrary'));

    $settings->add('resourcelibrary',
        new admin_externalpage('resourcelibrary_coursemodule_customfield',
            new lang_string('resourcelibrary_coursemodule_customfield', 'local_resourcelibrary'),
            $CFG->wwwroot . '/local/resourcelibrary/activityfields.php',
            array('local/resourcelibrary:manage')
        )
    );
    $settings->add('resourcelibrary',
        new admin_externalpage('resourcelibrary_course_customfield',
            new lang_string('resourcelibrary_course_customfield', 'local_resourcelibrary'),
            $CFG->wwwroot . '/local/resourcelibrary/coursefields.php',
            array('local/resourcelibrary:manage')
        )
    );
    if (!empty($CFG->enableresourcelibrary) && $CFG->enableresourcelibrary) {
        $ADMIN->add('courses', $settings); // Add it to the course menu.
    }
    // Create a global Advanced Feature Toggle.
    $enableoption = new admin_setting_configcheckbox('enableresourcelibrary',
        new lang_string('enableresourcelibrary', 'local_resourcelibrary'),
        new lang_string('enableresourcelibrary', 'local_resourcelibrary'),
        1);
    $enableoption->set_updatedcallback('local_resourcelibrary_enable_disable_plugin_callback');

    $optionalsubsystems = $ADMIN->locate('optionalsubsystems');
    $optionalsubsystems->add($enableoption);
}
