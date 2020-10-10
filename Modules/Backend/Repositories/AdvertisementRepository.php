<?php


namespace Modules\Backend\Repositories;


use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\Advertisement;

class AdvertisementRepository extends Repository
{
    public function __construct(Advertisement $advertisement)
    {
        $this->model = $advertisement;
    }

    public function getViewData($advertisement)
    {

        $selectPublishStatuses = [];
        $selectGuests = [];
        $selectReporters = [];
        return [
            'selectPublishStatuses' => $selectPublishStatuses,
            'selectReporter' => $selectReporters,
            'selectGuests' => $selectGuests,
            'selectAdsFor' => $this->ads_page(),
            'selectAdsSubFor' => $this->ads_Positions(),
            'placement' => $this->adsPlacements(),
            'advertisement' => $advertisement
        ];
    }

    public function ads_page()
    {
        return [
            'all_page' => 'All Pages',
            'main_page' => 'Main Page',
            'detail_page' => 'News Detail Page',
            'category_page' => 'Category Page',
        ];
    }

    public function ads_Positions()
    {

        $toArray = [
            'top_menu' => 'Top Menu',
            'logo_and_menu' => 'Logo and Menu',
            'logo' => 'Logo',
            'footer' => 'Footer',
        ];
        $categories = DB::table('categories')
            ->distinct()
            ->join('category_positions', 'categories.id', '=', 'category_positions.category_id')
            ->whereNotNull('front_body_position')
            ->orWhereNotNull('detail_body_position')
            ->select('categories.id', 'categories.slug', 'categories.name')
            ->get();
        foreach ($categories as $category) {
            $toArray[$category->slug] = $category->name;

        }
        return $toArray;

    }

    public function adsPlacements()
    {
        return
            [
                'above' => 'Above',
                'below' => 'Below',
                'aside' => 'Aside'
            ];
    }

    public function getAdvertisementPositions($positions)
    {
        $toArray = [];
        foreach ($positions as $position) {
            $toArray[strtolower($position)] = ucwords($position, '_');
        }
        return $toArray;


    }

    public function getAllAdvertisements($page)
    {

        $allAds = $this->getAdsByForAndSubForAndPlacement([$page, 'all_page']);
        return [
            'allAds' => $allAds
        ];
    }

    public function getAdsByForAndSubForAndPlacement(array $for)
    {

        return DB::table('advertisements')
            ->select('title', 'image', 'description', 'sub_description', 'url', 'for', 'sub_for', 'placement')
            ->whereIn('for', $for)
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get();
    }


}
