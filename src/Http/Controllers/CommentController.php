<?php


namespace Corals\Modules\CMS\Http\Controllers;

use Corals\Modules\CMS\Models\Post;
use Corals\Modules\Utility\Comment\Http\Controllers\CommentBaseController;
use Corals\Settings\Facades\Settings;

class CommentController extends CommentBaseController
{
    protected function setCommonVariables()
    {
        $this->commentableClass = Post::class;
        $this->requireApproval = Settings::get('cms_comments_require_approval');
    }

}
