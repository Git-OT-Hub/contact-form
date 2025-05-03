<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\Contracts\ContactServiceInterface;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    private ContactServiceInterface $contactService;

    public function __construct(ContactServiceInterface $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * お問い合わせ入力画面の表示
     * @return View
     */
    public function create(): View
    {
        $genderList = $this->contactService->getGenderList();
        $categoryList = $this->contactService->getCategoryList();

        return view('contacts.create', compact('genderList', 'categoryList'));
    }

    /**
     * お問い合わせ確認画面の表示
     * @param ContactRequest $request
     * @return View
     */
    public function confirm(ContactRequest $request): View
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel_first', 'tel_second', 'tel_third', 'address', 'building', 'category_id', 'detail']);

        return view('contacts.confirm', compact('contact'));
    }
}
