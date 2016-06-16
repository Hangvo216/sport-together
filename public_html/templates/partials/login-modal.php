<?php require_once (__DIR__ .'/../../../config.php'); ?>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">SIGN IN</h4>
			</div>
			<div class="modal-body">
				<button class="btn btn-facebook btn-primary btn-lg btn-block"
					onclick="window.location='<?php
					 echo "https://www.facebook.com/dialog/oauth?client_id=".$fizzyInit["fb-app-id"]."&redirect_uri=".$fizzyInit ['address']."api.php/fbcallback&scope=email,read_insights,manage_pages,publish_actions&state=AAAA"; ?>';">
					<i class="fa fa-facebook"></i> | Log In with Facebook
				</button>
			</div>
			<div class="modal-footer">
				<div class="row">
					<span class="pull-left col-xs-2 modal-links"><a href="#/sign-up">Register</a></span> <span
						class="pull-left col-xs-2 modal-links"><a href="mailto:support@meetcortex.com">Need help?</a></span>
					<div class="col-xs-8">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>