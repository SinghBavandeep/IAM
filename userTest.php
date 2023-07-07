<?php
// Read the contents of the template file
$template = file_get_contents('view/user/admin/AdminInterface.tpl');

// Set dynamic content
$dynamicContent = 'This is dynamic content';

// Replace placeholders in the template with dynamic content
$template = str_replace('{{dynamicContent}}', $dynamicContent, $template);

// Output the template
echo $template;
?>