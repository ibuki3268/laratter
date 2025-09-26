<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetLikeController extends Controller
{
    /**
     * �c�C�[�g�Ɂu�����ˁv��ǉ�����
     */
    public function store(Tweet $tweet)
    {
        // ? liked()�Ƃ��������[�V������ʂ��āA���݃��O�C�����Ă��郆�[�U�[��ID�𒆊ԃe�[�u���ɕۑ����܂�
        $tweet->liked()->attach(auth()->id());
        // ? ���O�̃y�[�W�Ƀ��_�C���N�g���܂�
        return back();
    }

    /**
     * �c�C�[�g�́u�����ˁv����������
     */
    public function destroy(Tweet $tweet)
    {
        // ? liked()�Ƃ��������[�V������ʂ��āA���݃��O�C�����Ă��郆�[�U�[��ID�𒆊ԃe�[�u������폜���܂�
        $tweet->liked()->detach(auth()->id());
        // ? ���O�̃y�[�W�Ƀ��_�C���N�g���܂�
        return back();
    }
}