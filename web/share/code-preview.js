/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 28.10.17
 * Time: 18:22
 */
(function($) {
    var $embeds = $('.code-embed');

    if ($embeds.length == 0){
      return;
    }

    $.ajax('/api/themes/', function (data) {
        console.log(data);
    });
}) (jQuery);
