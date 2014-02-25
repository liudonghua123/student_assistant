/**
 * Created by Liu.D.H on 13-12-22.
 */

/**
 *
 * @param $base_url
 * @param $paras_map
 * @returns {*}
 */
function make_request_url($base_url, $paras_map) {
    var $url = $base_url;
    $.map( $paras_map, function( v, k ) {
        $url += ('/' + k + '/' + v);
    });
    return $url;
}

$(function() {
    var player = new MediaElementPlayer('#audio_player');

    function play_audio($url) {
        player.pause();
        player.setSrc($url);
        player.play();
    }


    $(document).delegate('#player_list', 'click', function () {
        stroll.bind($( '#player_list_menu' ));
    });

});