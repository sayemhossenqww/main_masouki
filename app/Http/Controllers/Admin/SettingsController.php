<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SettingsController extends Controller
{

    /**
     * Show settings Page.
     *
     *  @return \Illuminate\View\View
     */
    public function show(): View
    {
        return view('admin.settings.show');
    }

    public function index()
    {
        $settings = Setting::all()->keyBy('id');
        return collect([
            'about' => $settings[Setting::ABOUT]->value,
            'usd_rate' => $settings[Setting::USD_RATE]->value,
            'global_alert' => $settings[Setting::GLOBAL_ALERT]->value
        ]);
    }

    /**
     * Update about us.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function updateAbout(Request $request): RedirectResponse
    {
        $request->validate([
            'value' => 'nullable|string',
        ]);

        $about = Setting::findOrFail(Setting::ABOUT);
        $about->update([
            'value' => $request->value
        ]);
        return Redirect::back()->with('success', 'About has been updated');
    }
    /**
     * Update about us.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function updateUsdRate(Request $request): RedirectResponse
    {
        $request->validate([
            'value' => ['required', 'numeric', 'min:0'],
        ]);

        $usdRate = Setting::findOrFail(Setting::USD_RATE);
        $usdRate->update([
            'value' => $request->value
        ]);
        return Redirect::back()->with('success', 'USD Rate has been updated.');
    }
    /**
     * Update global alert.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function updateGlobalAlert(Request $request): RedirectResponse
    {
        $request->validate([
            'value' => 'nullable|string',
        ]);

        $global_alert = Setting::findOrFail(Setting::GLOBAL_ALERT);
        $global_alert->update([
            'value' => $request->value
        ]);
        return Redirect::back()->with('success', 'Global alert, has been updated.');
    }
}
