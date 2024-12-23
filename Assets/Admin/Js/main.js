/**
 * @author      Flycart (Alagesan)
 * @license     http://www.gnu.org/licenses/gpl-3.0.html
 * @link        https://www.flycart.org
 * */

if (typeof (wai_jquery) == 'undefined') {
    wai_jquery = jQuery.noConflict();
}

wai = window.wai || {};
(function (wai) {

    wai.query = async function query(data, url) {
        const response = await fetch(
            url,
            {
                headers: {
                    Authorization: "Bearer " + wai_localize_data.api_token,
                    "Content-Type": "application/json",
                },
                method: "POST",
                body: JSON.stringify(data),
            }
        );
        const result = await response.blob();
        return result;
    }

    wai_jquery(document).on("click", "#wai-reward-link", function (e) {
        let data = {
            'inputs': wai_jquery('#ai_prompt').val(),
        }
        let url = wai_jquery('#ai-list-img :selected').data('url');
        console.log(data);
        console.log(url);
        wai.query(data, url).then((response) => {
            const blobUrl = URL.createObjectURL(response);
            wai_jquery('.image1').attr('src', blobUrl)
        });
    });
    /*wai_jquery(document).on("click", "#wai-reward-link", function (e) {
        let data = {
            action: "wai_ai_call",
            model: "text_to_image",
            type: wai_jquery('#ai-list-img').val(),
            content: wai_jquery('#ai_prompt').val(),
            wai_nonce: wai_localize_data.wai_ai_nonce,
        };
        wai_jquery(this).after('<div class="wai-dot-pulse"></div>');
        wai_jquery.ajax({
            type: "POST",
            url: wai_localize_data.ajax_url,
            data: data,
            dataType: "json",
            before: function () {

            },
            success: function (json) {
                wai_jquery('.image1').attr('src', json.data.content)
            }
        });
    });*/
})(wai_jquery);
