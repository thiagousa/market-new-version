<?php namespace App\Http\Controllers;

use App\Exceptions\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

use App\ACL;
use App\Settings;

class SettingsController extends Controller
{
    protected $ACL;
    protected $money;
    protected $settings;
    public $folder;
    public $settingsId;
    public $faviconWidth;
    public $faviconHeight;
    public $avatarWidth;
    public $avatarHeight;
    public $appleTouchIconWidth;
    public $appleTouchIconHeight;

    public function __construct(ACL $ACL, Money $money, Settings $settings)
    {
        $this->middleware('auth');
        $this->folder               = "assets/settings/";
        $this->settingsId           = 1;
        $this->faviconWidth         = 16;
        $this->faviconHeight        = 16;
        $this->avatarWidth          = 250;
        $this->avatarHeight         = 250;
        $this->appleTouchIconWidth  = 129;
        $this->appleTouchIconHeight = 129;
        $this->ACL                  = $ACL;
        $this->money                = $money;
        $this->settings             = $settings;
    }

    public function getIndex()
    {
        if (!$this->ACL->hasPermission('settings', 'edit')) {
            return redirect(route('home'))->withErrors(['You do not have permission for edit the settings.']);
        }

        $imageDetails = [
            'folder'                => $this->folder,
            'faviconWidth'          => $this->faviconWidth,
            'faviconHeight'         => $this->faviconHeight,
            'avatarWidth'           => $this->avatarWidth,
            'avatarHeight'          => $this->avatarHeight,
            'appleTouchIconWidth'   => $this->appleTouchIconWidth,
            'appleTouchIconHeight'  => $this->appleTouchIconHeight
        ];

        $settings = $this->settings->where('settingsId', '=', $this->settingsId)->first();
        array_set($settings, 'dollarQuotation', $this->money->convertDatabaseToView($settings->dollarQuotation, 2, ',', '.'));

        return view('settings.index')->with(compact('settings', 'imageDetails'));
    }

    public function putUpdate(Request $request)
    {
        if (!$this->ACL->hasPermission('settings', 'edit')) {
            return redirect(route('home'))->withErrors(['You do not have permission for edit the settings.']);
        }

        $this->validate($request, [
            'title'             => 'required|max:100',
            'email'             => 'required|email|max:50',
            'dollarQuotation'   => 'required|max:13',
            'favicon'           => 'image|mimes:gif,png',
            'avatar'            => 'image|mimes:jpeg,gif,png',
            'appleTouchIcon'    => 'image|mimes:png'
        ]);

        $settings = $this->settings->find($this->settingsId);
        $settings->title             = $request->title;
        $settings->email             = $request->email;
        $settings->dollarQuotation   = $this->money->convertViewToDatabase($request->dollarQuotation, 'BRL');
        if($request->maintenance == null){
            $settings->maintenance   = false;
        }else{
            $settings->maintenance   = $request->maintenance;
        }

        if ($request->favicon) {
            //DELETE OLD FAVICON
            if($request->currentFavicon != ""){
                if(File::exists($this->folder.$request->currentFavicon)){
                    File::delete($this->folder.$request->currentFavicon);
                }
            }
            $extension = $request->favicon->getClientOriginalExtension();
            $nameFavicon = "favicon.".$extension;

            Image::make($request->file('favicon'))->resize($this->faviconWidth, $this->faviconHeight)->save($this->folder.$nameFavicon);

            $settings->favicon = $nameFavicon;
        }
        if ($request->avatar) {
            //DELETE OLD AVATAR
            if($request->currentAvatar != ""){
                if(File::exists($this->folder.$request->currentAvatar)){
                    File::delete($this->folder.$request->currentAvatar);
                }
            }
            $extension = $request->avatar->getClientOriginalExtension();
            //$nameAvatar = Carbon::now()->format('YmdHis').".".$extension;
            $nameAvatar = "avatar.".$extension;

            $img = Image::make($request->file('avatar'));
            if($request->avatarCropAreaW > 0 or $request->avatarCropAreaH > 0 or $request->avatarPositionX or $request->avatarPositionY){
                $img->crop($request->avatarCropAreaW, $request->avatarCropAreaH, $request->avatarPositionX, $request->avatarPositionY);
            }
            $img->resize($this->avatarWidth, $this->avatarHeight)->save($this->folder.$nameAvatar);

            $settings->avatar = $nameAvatar;
        }
        if ($request->appleTouchIcon) {
            //DELETE OLD APPLE TOUCH ICON
            if($request->currentAppleTouchIcon != ""){
                if(File::exists($this->folder.$request->currentAppleTouchIcon)){
                    File::delete($this->folder.$request->currentAppleTouchIcon);
                }
            }
            $extension = $request->appleTouchIcon->getClientOriginalExtension();
            $nameAppleTouchIcon = "apple-touch-icon.".$extension;

            Image::make($request->file('appleTouchIcon'))->resize($this->appleTouchIconWidth, $this->appleTouchIconHeight)->save($this->folder.$nameAppleTouchIcon);

            $settings->appleTouchIcon = $nameAppleTouchIcon;
        }

        $settings->save();

        $success = "Settings updated successfully";

        return redirect(route('settings'))->with(compact('success'));

    }
}