<?php

namespace Terminal42\ActiveCollabApi\Model;

/**
 * Class Info
 *
 * @property $api_version - The version of the activeCollab API.
 * @property $system_version - The version of activeCollab that you are communicating with.
 * @property $loaded_frameworks - The loaded activeCollab frameworks.
 * @property $enabled_modules - The modules enabled in this activeCollab setup.
 * @property $logged_user - The URL of the users currently logged in.
 * @property $read_only - The value is set to 1 if the API is in read only mode, or 0 if it supports both read and write requests.
 */
class Info extends AbstractModel
{
}