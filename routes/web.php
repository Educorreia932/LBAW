<?php

use Facade\FlareClient\View;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', 'HomeController@show')->name("home");

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login_form');
Route::post('login', 'Auth\LoginController@login')->name("login");
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register_form');
Route::post('register', 'Auth\RegisterController@register')->name("register");
Route::get("auth/redirect/{provider}", "SocialController@redirect")->name("auth_redirect");
Route::get("callback/{provider}", "SocialController@callback")->name("callback");

// Search Results
Route::get('auction/search', 'SearchResultsController@search_auctions')->name('search_auctions');
Route::get('user/search', 'SearchResultsController@search_users')->name('search_users');

// Auctions
Route::get("auction/{id}/details", "AuctionController@redirectPrettyUrlDetails")->where('id', '[0-9]+')->name("auction_details");
Route::get("auction/{id}-{prettyurl}/details", "AuctionController@showDetails")->where('id', '[0-9]+')->name("auction_details_pretty_url");
Route::get("auction/{id}", "AuctionController@redirectPrettyUrl")->where('id', '[0-9]+')->name("auction");
Route::get("auction/{id}-{prettyurl}", "AuctionController@show")->where('id', '[0-9]+')->name("auction_pretty_url");

// Authenticated only
Route::middleware(['auth'])->group(function () {
    // Authentication
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    // Create Auction
    Route::get("auction/create", "AuctionController@create")->name("create_auction");
    Route::post("auction/create", "AuctionController@store")->name("store_auction");

    // Bid Auction
    Route::post("auction/{id}/bid", "AuctionController@bid")->name("auction_bid");

    // User Profile
    Route::get("users/me", "UserController@showMyProfile")->name('my_profile');
    Route::post("users/{username}/rate", "UserController@rate")->name("rate_user");

    // Auction Report
    Route::post("auction/{id}/report", "AuctionController@report")->where('id', '[0-9]+')->name("auction_report");

    // Auction Editing
    Route::post("auction/{id}/edit", "AuctionController@edit")->where('id', '[0-9]+')->name("auction_edit");

    // Auction Bookmark
    Route::put("auction/{id}/bookmark", "AuctionController@bookmark")->where('id', '[0-9]+')->name("bookmark");
    Route::delete("auction/{id}/bookmark", "AuctionController@unbookmark")->where('id', '[0-9]+')->name("unbookmark");

    // Follow
    Route::put("users/{username}/follow", "UserController@follow")->name("follow");
    Route::delete("users/{username}/follow", "UserController@unfollow")->name("unfollow");

    // Dashboard
    Route::get("dashboard", fn() => redirect("dashboard/created_auctions"))->name("dashboard");
    Route::get("dashboard/created_auctions", "DashboardController@createdAuctions")->name("dashboard_created_auctions");
    Route::get("dashboard/bidded_auctions", "DashboardController@biddedAuctions")->name("dashboard_bidded_auctions");
    Route::get("dashboard/bookmarked_auctions", "DashboardController@bookmarkedAuctions")->name("dashboard_bookmarked_auctions");
    Route::get("dashboard/followed", "DashboardController@followed")->name("dashboard_followed");

    // Settings
    Route::get("user/settings/", fn() => redirect("user/settings/account"))->name("settings");
    Route::get("user/settings/account", "SettingsController@account")->name("settings_account");
    Route::put("user/settings/account", "SettingsController@save_account_changes")->name("save_account_changes");
    Route::get("user/settings/privacy", "SettingsController@privacy")->name("settings_privacy");
    Route::put("user/settings/privacy/toggle", "SettingsController@toggle_settings")->name("toggle_settings");
    Route::get("user/settings/security", "SettingsController@security")->name("settings_security");
    Route::put("user/settings/security/password", "SettingsController@change_password")->name("change_password");

    // Messages
    Route::get("messages", "MessageController@showInbox")->name("inbox");
    Route::post("messages", "MessageController@createMessageThread")->name("create_message_thread");
    Route::get("messages/{thread_id}", "MessageController@showMessageThread")->name("message_thread");
    Route::put("messages/{thread_id}", "MessageController@sendMessage")->name("send_message");
    Route::post("messages/{thread_id}/add_participant", "MessageController@addParticipantToThread")->name("add_participant_to_message_thread");
    Route::post("messages/{thread_id}/rename", "MessageController@renameThread")->name("rename_thread");
});

// User Profile
Route::get("users/{username}", "UserController@showProfile")->name('user_profile');

// Other
Route::get('about', "AboutController@show")->name("about");
Route::get('faq', "FaqController@show")->name("faq");

// Administration
Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function () {
    // // Authentication
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login_form');
    Route::post('login', 'Auth\LoginController@login')->name("login");

    // Logout admin
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    // Home (Dashboard)
    Route::get("dashboard", fn() => redirect("admin/dashboard/user_management"))->name("dashboard");
    Route::get("dashboard/user_management", "DashboardController@manageUsers")->name("user_management");
    Route::get("dashboard/reported_users", "DashboardController@reportedUsers")->name("reported_users");
    Route::get("dashboard/reported_users/{username}", "DashboardController@userReports")->name("user_reports");
    Route::get("dashboard/auction_management", "DashboardController@manageAuctions")->name("auction_management");
    Route::get("dashboard/reported_auctions", "DashboardController@reportedAuctions")->name("reported_auctions");
    Route::get("dashboard/reported_auctions/{id}", "DashboardController@auctionReports")->where('id', '[0-9]+')->name("auction_reports");

    Route::put("ban/{id}", "AdminController@banUser")->where('id', '[0-9]+')->name("ban_user");
    Route::put("unban/{id}", "AdminController@unbanUser")->where('id', '[0-9]+')->name("unban_user");
    Route::put("revoke_sell/{id}", "AdminController@revokeSell")->where('id', '[0-9]+')->name('revoke_sell');
    Route::put("restore_sell/{id}", "AdminController@restoreSell")->where('id', '[0-9]+')->name('restore_sell');
    Route::put("revoke_bid/{id}", "AdminController@revokeBid")->where('id', '[0-9]+')->name('revoke_bid');
    Route::put("restore_bid/{id}", "AdminController@restoreBid")->where('id', '[0-9]+')->name('restoreBid');
    Route::put("terminate_auction/{id}", "AdminController@terminateAuction")->where('id', '[0-9]+')->name('terminate_auction');
    Route::put("activate_auction/{id}", "AdminController@activateAuction")->where('id', '[0-9]+')->name('activate_auction');
});
