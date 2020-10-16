<?php

namespace App\Http\Controllers\Kaltura;

use App\Apis\Kaltura\MediaEntryOrderBy;
use App\Apis\Kaltura\KalturaMedia;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;
use Kaltura\Client\Type\FilterPager;
use Kaltura\Client\Type\MediaEntryFilter;

class EntryController extends Controller
{
    private $pageSize = 10;
    private $kalturaMedia;

    public function __construct()
    {
        $ks = session('ks');
        $this->kalturaMedia = new KalturaMedia($ks);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get normalized input
        $input = $this->normalizeInput(request()->all());

        // Prepare filter
        $filter = $this->prepareMediaEntryFilter($input);

        // Prepare pager
        $pager = $this->prepareFilterPager($input);

        // Get entries from Api
        $result = $this->kalturaMedia->list($filter, $pager);

        // Create paginator
        $entries = new LengthAwarePaginator(
            $result->objects,
            $result->totalCount,
            $this->pageSize,
            $input['_page']
        );
        $entries->setPath('entries')->setPageName('_page')->appends($input);

        $orderUrlParams = array_merge($input, ['_order' => MediaEntryOrderBy::inverse($input['_order'])]);

        // Load the view and pass the data
        return view('entries.index', compact('input', 'orderUrlParams', 'entries'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->kalturaMedia->delete($id);

            Session::flash('success', 'Entry was successfully deleted.');
        } catch (Exception $e) {
            Session::flash('error', 'An error occurred.');
        }

        return redirect(url()->previous());
    }

    private function normalizeInput($input)
    {
        $input['_page'] = $input['_page'] ?? 1;
        $input['_order'] = $input['_order'] ?? MediaEntryOrderBy::CREATED_AT_DESC;
        $input['freeText'] = $input['freeText'] ?? '';

        return $input;
    }

    private function prepareMediaEntryFilter($input)
    {
        $filter = new MediaEntryFilter();
        $filter->orderBy = $input['_order'];
        $filter->freeText = $input['freeText'];

        return $filter;
    }

    private function prepareFilterPager($input)
    {
        $pager = new FilterPager();
        $pager->pageIndex = $input['_page'];
        $pager->pageSize = $this->pageSize;

        return $pager;
    }
}
