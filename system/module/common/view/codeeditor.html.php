<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php js::import($jsRoot . 'ace/ace.js');?>
<style>
.editor-wrapper {position: relative; z-index: 1;}
.editor-wrapper pre {z-index: 2}
.editor-wrapper .actions {position: absolute; right: 15px; top: 10px; z-index: 3;}
.editor-wrapper .actions > a {color: #808080; border: 1px solid #aaa; min-width: 14px; height: 24px; line-height: 24px; text-align: center; display: block; border-radius: 3px; float: left; margin-left: 6px; padding: 0 5px}
.editor-wrapper .actions > a:hover {color: #999}
.editor-wrapper.fullscreenn {position: fixed; left: 0; top: 40px; bottom: 40px; right: 0}
.editor-wrapper.fullscreenn .pre {height: 100%; width: 100%}
.editor-wrapper .ace-themes.dropdown-menu {width: 323px}
.editor-wrapper .ace-themes.dropdown-menu > li {float: left; width: 160px}
</style>
<script>
jQuery.fn.codeeditor = function(options)
{
    return this.each(function()
    {
        var $this = $(this).css('display', 'none');
        var id = $this.attr('id') + '-editor';
        var setting = $.extend({mode: 'html', theme: 'textmate'}, $this.data(), options);
        $this.before('<div class="editor-wrapper"><div class="actions"><a href="javascript:;" class="btn-fullscreen"><i class="icon-resize-full"></i></a><a href="javascript:;" data-toggle="dropdown"><i class="icon-adjust"></i> <span class="ace-theme">textmate</span> <i class="icon-caret-down"></i></a><ul class="dropdown-menu pull-right ace-themes"><li><a href="###">ambiance</a></li><li><a href="###">chaos</a></li><li class="active"><a href="###">chrome</a></li><li><a href="###">clouds_midnight</a></li><li><a href="###">clouds</a></li><li><a href="###">cobalt</a></li><li><a href="###">crimson_editor</a></li><li><a href="###">dawn</a></li><li><a href="###">dreamweaver</a></li><li><a href="###">eclipse</a></li><li><a href="###">github</a></li><li><a href="###">idle_fingers</a></li><li><a href="###">katzenmilch</a></li><li><a href="###">kr</a></li><li><a href="###">kuroir</a></li><li><a href="###">merbivore_soft</a></li><li><a href="###">merbivore</a></li><li><a href="###">mono_industrial</a></li><li><a href="###">monokai</a></li><li><a href="###">pastel_on_dark</a></li><li><a href="###">solarized_dark</a></li><li><a href="###">solarized_light</a></li><li><a href="###">terminal</a></li><li><a href="###">textmate</a></li><li><a href="###">tomorrow_night_blue</a></li><li><a href="###">tomorrow_night_bright</a></li><li><a href="###">tomorrow_night_eighties</a></li><li><a href="###">tomorrow_night</a></li><li><a href="###">tomorrow</a></li><li><a href="###">twilight</a></li><li><a href="###">vibrant_ink</a></li><li><a href="###">xcode</a></li></ul></div><pre id="{0}"></pre></div>'.format(id));
        var $editor = $('#' + id).addClass('ace-editor').height($this.height()),
            editor = ace.edit(id);
        var $wrapper = $editor.closest('.editor-wrapper');
        editor.setValue($this.val());
        editor.clearSelection();
        editor.setTheme("ace/theme/" + setting.theme);
        editor.getSession().setMode("ace/mode/" + setting.mode);
        editor.getSession().on('change', function(e)
        {
            $this.val(editor.getValue());
        });

        $this.data('editor', editor);

        $wrapper.find('.btn-fullscreen').click(function()
        {
            $wrapper.toggleClass('fullscreenn');
            $('body').toggleClass('codeeditor-fullscreen');
            $(this).find('i').toggleClass('icon-resize-small');
            if($wrapper.hasClass('fullscreenn'))
            {
                $editor.data('origin-height', $editor.height()).height($wrapper.height());
            }
            else
            {
                $editor.height($editor.data('origin-height'));
            }
            editor.resize();
        });

        $wrapper.find('.ace-themes > li > a').click(function()
        {
            $wrapper.find('.ace-themes > li.active').removeClass('active');
            $(this).closest('li').addClass('active');
            var theme = $(this).text();
            $wrapper.find('.ace-theme').text(theme);
            editor.setTheme("ace/theme/" + theme);
        });
    });
};
$(function()
{
    $('.codeeditor').codeeditor();
});
</script>
