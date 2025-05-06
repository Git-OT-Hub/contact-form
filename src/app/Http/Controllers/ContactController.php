<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\Contracts\ContactServiceInterface;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as HttpResponse;

class ContactController extends Controller
{
    private array $contactFormItems = ['last_name', 'first_name', 'gender', 'email', 'tel_first', 'tel_second', 'tel_third', 'address', 'building', 'category_id', 'detail'];

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
        $contact = $request->only($this->contactFormItems);
        $genderList = $this->contactService->getGenderList();
        $categoryList = $this->contactService->getCategoryList();

        return view('contacts.confirm', compact('contact', 'genderList', 'categoryList'));
    }

    /**
     * お問い合わせ修正、登録処理
     * @param ContactRequest $request
     * @return RedirectResponse
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        if ((string)$request->submit === 'fix') {
            return redirect()->route('contacts.create')->withInput();
        }

        $contact = $request->only($this->contactFormItems);
        $this->contactService->create($contact);

        return redirect()->route('contacts.thanks');
    }

    /**
     * サンクスページの表示
     * @return View
     */
    public function thanks(): View
    {
        return view('contacts.thanks');
    }

    /**
     * 管理画面の表示
     * @return View
     */
    public function index(): View
    {
        $genderList = $this->contactService->getGenderList();
        $categoryList = $this->contactService->getCategoryList();
        $contactList = $this->contactService->getContactList();

        return view('admin.index', compact('genderList', 'categoryList', 'contactList'));
    }

    /**
     * 検索結果の表示
     * @param Request $request 検索内容
     * @return RedirectResponse|View
     */
    public function search(Request $request): RedirectResponse|View
    {
        if ((string)$request->submit === 'reset') {
            return redirect()->route('admin.index');
        }

        $search = [
            'keyword' => $request->keyword ?? '',
            'gender' => $request->gender ?? '',
            'category_id' => $request->category_id ?? '',
            'created_at' => $request->created_at ?? '',
        ];

        $keyword = $search['keyword'];
        $gender = $search['gender'];
        $category_id = $search['category_id'];
        $created_at = $search['created_at'];

        $genderList = $this->contactService->getGenderList();
        $categoryList = $this->contactService->getCategoryList();
        $contactList = $this->contactService->searchContacts($search);

        return view('admin.index', compact('genderList', 'categoryList', 'contactList', 'keyword', 'gender', 'category_id', 'created_at'));
    }

    /**
     * お問い合わせ削除
     * @param Contact $contact
     * @return RedirectResponse
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $this->contactService->deleteContact($contact);

        return redirect()->route('admin.index');
    }

    /**
     * 問い合わせ内容のCSV出力機能
     * @param Request $request 検索内容
     * @return HttpResponse
     */
    public function downloadCsv(Request $request): HttpResponse
    {
        $search = [
            'keyword' => $request->keyword ?? '',
            'gender' => $request->gender ?? '',
            'category_id' => $request->category_id ?? '',
            'created_at' => $request->created_at ?? '',
        ];
        $flag = 'paginate_none';

        $contactList = $this->contactService->searchContacts($search, $flag);
        $genderList = $this->contactService->getGenderList();
        $responseItems = $this->contactService->processForCSV($contactList, $genderList);

        return Response::make($responseItems['csv'], 200, $responseItems['headers']);
    }
}
