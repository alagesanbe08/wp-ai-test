<?php
?>
<style>
</style>
<div class="first">
    <input type="text" name="ai_prompt" id="ai_prompt" value="indian boy">
    <select name="ai_model" id="ai-list-img">
		<?php foreach ( $ai_list as $key => $item ): ?>
            <option value="<?php echo $key; ?>"
                    data-url="<?php echo $item['url']; ?>"><?php echo $item['label']; ?></option>
		<?php endforeach; ?>
    </select>
    <button id="wai-reward-link">Click Me</button>
    <img width="500px" height="500px" class="image1"
         src="<?php echo WAI_PLUGIN_URL . '/file/BlackForestLabs/black-forest-labs.png' ?>"
         alt="image1"/></div>