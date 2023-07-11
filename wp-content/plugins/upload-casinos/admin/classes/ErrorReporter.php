<?php

namespace UploadCasinos\Classes;

class ErrorReporter
{
public static function report_missing_contact_form_plugin(): void
{
    echo '<div class="error"><p>Plugin BG Process: Contact Form 7 plugin is required! Install and/or activate the plugin!</p></div>';
}
}