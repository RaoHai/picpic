// dynamically load external JS files when document ready
// dynamically load external JS files when document ready
function loadScriptsAfterDocumentReady()
{
    if (_lazyLoadScripts && _lazyLoadScripts != null)
    {
        for (var i = 0; i < _lazyLoadScripts.length; i++)
        {
            var scriptTag = document.createElement('script');
            scriptTag.type = 'text/javascript';
            scriptTag.src = _lazyLoadScripts[i];
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(scriptTag, firstScriptTag);
        }
    }
}
 
// Execute the callback when document ready.
function invokeLazyExecutedCallbacks()
{
    if (_lazyExecutedCallbacks && _lazyExecutedCallbacks.length > 0)
        for(var i=0; i<_lazyExecutedCallbacks.length; i++)
            _lazyExecutedCallbacks[i]();
}
 
// execute all deferring JS when document is ready by using jQuery.
jQuery(document).ready(function ()
{
    loadScriptsAfterDocumentReady();
    invokeLazyExecutedCallbacks();
});

