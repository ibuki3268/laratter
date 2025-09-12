<?php

it('has tweetlike page', function () {
    $response = $this->get('/tweetlike');

    $response->assertStatus(200);
});
