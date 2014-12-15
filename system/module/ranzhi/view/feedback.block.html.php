<div class='div-feedback'>
  <ul class="nav nav-primary nav-stacked">
    <li><?php echo html::a(getWebRoot(true) . ltrim($this->createLink('message', 'admin', "type=message"), '/'), sprintf($lang->ranzhi->messageWating, $messages), "target='_blank'");?></li>
    <li><?php echo html::a(getWebRoot(true) . ltrim($this->createLink('message', 'admin', "type=comment"), '/'), sprintf($lang->ranzhi->commentWating, $comments), "target='_blank'");?></li>
    <li><?php echo html::a(getWebRoot(true) . ltrim($this->createLink('message', 'admin', "type=reply"), '/'),   sprintf($lang->ranzhi->messageReplyWating, $messageReplies), "target='_blank'");?></li>
    <li><?php echo html::a(getWebRoot(true) . ltrim($this->createLink('forum', 'admin', 'tab=feedback'), '/'),   sprintf($lang->ranzhi->newThreads, $threads), "target='_blank'");?></li>
    <li><?php echo html::a(getWebRoot(true) . ltrim($this->createLink('reply', 'admin'), '/'),                   sprintf($lang->ranzhi->newReplies, $forumReplies), "target='_blank'");?></li>
  </ul>
</div>
