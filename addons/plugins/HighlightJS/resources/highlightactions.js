$(function() {
	function activateHighlights() {
		$('pre').each(function(i, block) {
			hljs.highlightBlock(block);
		});
	}
	var initPost = ETConversation.initPost;
	ETConversation.initPost = function(postId, html) {
		initPost(postId, html);
		activateHighlights();
	};
	
	var restorePost = ETConversation.restorePost;
	ETConversation.restorePost = function(postId) {
		var redisplayAvatars = ETConversation.redisplayAvatars;
		ETConversation.redisplayAvatars = function() {
			redisplayAvatars();
			activateHighlights();
			ETConversation.redisplayAvatars = redisplayAvatars;
		};
		restorePost(postId);
	};
});

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('pre').forEach((pre) => {
        // Create the button
        const button = document.createElement('button');
        button.innerText = 'Copy';
        button.className = 'copy-btn';

        // Add click event
        button.addEventListener('click', () => {
            const code = pre.querySelector('code');
            const textToCopy = code ? code.innerText : pre.innerText;
            
            navigator.clipboard.writeText(textToCopy).then(() => {
                button.innerText = 'Copied!';
                setTimeout(() => { button.innerText = 'Copy'; }, 2000);
            });
        });

        // Add to the pre
        pre.style.position = 'relative';
        pre.appendChild(button);
    });
});