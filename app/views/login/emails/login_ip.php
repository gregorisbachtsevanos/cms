<?php
$html_body = '<html>
  <body bgcolor="#222">
	<div style="width: 100%; background-color: #222; padding: 20px; font-family: font-size: 14px; line-height: 1.43; font-family: Helvetica Neue, Segoe UI, Helvetica, Arial, sans-serif;">
    <div style="max-width: 600px; margin: 10px auto 20px; font-size: 12px; color: #A5A5A5; text-align: center;">
      If you are unable to see this message, <a href="#" style="color: #A5A5A5; text-decoration: underline;">click here to view in browser</a>
    </div>
    <div style="max-width: 600px; margin: 0px auto; background-color: #fff; box-shadow: 0px 20px 50px rgba(0,0,0,0.05);">
      <table style="width: 100%;">
        <tr>
          <td style="background-color: #fff;">
            <img alt="'.$appName.'" src="https://thumb.ibb.co/gXzqx8/logo.png" style="width: 70px; padding: 20px">
          </td>
          <td style="padding-left: 50px; text-align: right; padding-right: 20px;">
            <a href="#" style="color: #261D1D; text-decoration: underline; font-size: 14px; letter-spacing: 1px;">Sign In</a><a href="#" style="color: #7C2121; text-decoration: underline; font-size: 14px; margin-left: 20px; letter-spacing: 1px;">Forgot Password</a>
          </td>
        </tr>
      </tbody></table><div style="padding: 60px 70px; border-top: 1px solid rgba(0,0,0,0.05);">
        <h1 style="margin-top: 0px;">Login Notification</h1>
        <div style="color: #636363; font-size: 14px;">
          <p>Hi '.$row->name.',</p>
			<p>We wanted to let you know that someone just logged into your account from an unknown IP address. You can find his information bellow:</p>
			<p><strong>IP:</strong> '.$user_ip.' <small><a href="https://tools.keycdn.com/geo?host='.$user_ip.'">(See more)</a></small><br>
				<strong>Browser:</strong> '.$user_browser.'<br>
				<strong>Operating System:</strong> '.$user_os.'<br>
				<strong>Date:</strong> '.date('m-d-Y H:i', time()).'
			</p>
        </div>
        <a href="'.$appURL.'login/reset-password/'.$row->id.'-'.$row->auth_hash.'?revoke=1" style="padding: 6px 16px;background-color: #E91E63;color: #fff;font-weight: bolder;font-size: 16px;display: inline-block;margin: 20px 0px;margin-right: 20px;text-decoration: none;">This wasn\'t me</a>
        <h4 style="margin-bottom: 10px;">
          Need Help?
        </h4>
        <div style="color: #A5A5A5; font-size: 12px;">
          <p>
            If you have any questions you can simply reply to this email or find our contact information <a href="#" style="text-decoration: underline; color: #4B72FA;">here</a>.
          </p>
        </div>
      </div><div style="background-color: #F5F5F5; padding: 40px; text-align: center;">
        <div style="margin-bottom: 20px;">
          <a href="#" style="text-decoration: underline; font-size: 14px; letter-spacing: 1px; margin: 0px 15px; color: #261D1D;">Contact Us</a><a href="#" style="text-decoration: underline; font-size: 14px; letter-spacing: 1px; margin: 0px 15px; color: #261D1D;">Privacy Policy</a><a href="#" style="text-decoration: underline; font-size: 14px; letter-spacing: 1px; margin: 0px 15px; color: #261D1D;">Helpdesk</a>
        </div>
        <div style="color: #A5A5A5; font-size: 12px; margin-bottom: 20px; padding: 0px 50px;">
          You are receiving this email because you have enabled login notifications. You can change your notification settings at your <a href="#" style="text-decoration: underline; color: #4B72FA;">account\'s page</a>.
        </div>
        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(0,0,0,0.05);">
          <div style="color: #A5A5A5; font-size: 10px; margin-bottom: 5px;">
            Laertou 22, Thessaloniki, 57001, Greece
          </div>
          <div style="color: #A5A5A5; font-size: 10px;">
            Copyright 2018 '.$appName.'. All rights reserved.
          </div>
        </div>
      </div>
    </div>
	</div>
</body></html>';
