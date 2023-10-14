<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\ConstructorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileManagementDirController;
use App\Http\Controllers\FileManagementFileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\FileManagementController;
use App\Http\Controllers\ModuleColumnController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ModuleDatabaseController;
use App\Http\Controllers\ModuleTemplateController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserHistoryController;
use App\Http\Controllers\WebBlockController;
use App\Http\Controllers\WebBreadcrumbController;
use App\Http\Controllers\WebDataController;
use App\Http\Controllers\WebMenuController;
use App\Http\Controllers\WebMenuItemController;
use App\Http\Controllers\WebMenuTemplateController;
use App\Http\Controllers\WebPageController;
use App\Http\Controllers\WebPageCopyController;
use App\Http\Controllers\WebPageLanguageVersionController;
use App\Http\Controllers\WebPageTemplateController;
use App\Http\Controllers\WebPaginationController;
use App\Http\Controllers\WebResourceController;
use App\Http\Controllers\WebRobberController;
use App\Http\Controllers\WebSiteCodeController;
use App\Http\Controllers\WebSiteController;
use App\Http\Controllers\WebSiteCopyController;
use App\Http\Controllers\WebVariableController;
use Illuminate\Support\Facades\Route;

$_app_domain = env('APP_HOSTNAME');
$_current_domain = request()->getHttpHost();

/**
 * Constructor
 */
if($_app_domain != $_current_domain) {
    Route::name('constructor.')->group(function() {
        Route::match(['GET', 'HEAD'], '/', [
            ConstructorController::class, 'index'
        ])->name('index');

        Route::match(['POST'], '/', [
            ConstructorController::class, 'store'
        ])->name('store');

        Route::match(['GET', 'HEAD'], '/{route}', [
            ConstructorController::class, 'index'
        ])->name('index')->where('route', '.*?');
    });
}

/**
 * App
 */
Route::domain(explode(':', $_app_domain)[0])->group(function() {
    /**
     * Auth
     */
    require_once __DIR__ . '/auth.php';

    /**
     * Home
     */
    Route::get('/', function() {
        if(auth()->check()) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('login');
    });

    /**
     * For authorized
     */
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [
            DashboardController::class, 'index'
        ])->name('dashboard');

        Route::prefix('resources')->name('resources.')->group(function() {
            Route::match(['GET', 'HEAD'], '/', [
                ResourceController::class, 'index'
            ])->name('index')->middleware('permission:Cms:Resource:Index');

            Route::match(['GET', 'HEAD'], '/create', [
                ResourceController::class, 'create'
            ])->name('create')->middleware('permission:Cms:Resource:Create');

            Route::match(['POST'], '/', [
                ResourceController::class, 'store'
            ])->name('store')->middleware('permission:Cms:Resource:Create');

            Route::match(['POST'], '/position', [
                ResourceController::class, 'position'
            ])->name('position')->middleware('permission:Cms:Resource:Update');

            Route::prefix('{resource}')->group(function() {
                Route::match(['DELETE'], '/', [
                    ResourceController::class, 'destroy'
                ])->name('destroy')->middleware('permission:Cms:Resource:Delete');
            });
        });

        Route::prefix('users')->name('users.')->group(function() {
            Route::match(['GET', 'HEAD'], '/', [
                UserController::class, 'index'
            ])->name('index')->middleware('permission:Cms:User:Index');

            Route::match(['GET', 'HEAD'], '/create', [
                UserController::class, 'create'
            ])->name('create')->middleware('permission:Cms:User:Create');

            Route::match(['POST'], '/', [
                UserController::class, 'store'
            ])->name('store')->middleware('permission:Cms:User:Create');

            Route::prefix('{user}')->group(function() {
                Route::match(['GET', 'HEAD'], '/', [
                    UserController::class, 'show'
                ])->name('show')->middleware('permission:Cms:User:View');

                Route::match(['GET', 'HEAD'], '/edit', [
                    UserController::class, 'edit'
                ])->name('edit')->middleware('permission:Cms:User:Update');

                Route::match(['PUT', 'PATCH'], '/', [
                    UserController::class, 'update'
                ])->name('update')->middleware('permission:Cms:User:Update');

                Route::match(['DELETE'], '/', [
                    UserController::class, 'destroy'
                ])->name('destroy')->middleware('permission:Cms:User:Delete');
            });
        });

        Route::prefix('user-history')->name('user-history.')->group(function() {
            Route::match(['GET', 'HEAD'], '/', [
                UserHistoryController::class, 'index'
            ])->name('index')->middleware('permission:Cms:UserHistory:Index');

            Route::match(['GET', 'HEAD'], '/create', [
                UserHistoryController::class, 'create'
            ])->name('create')->middleware('permission:Cms:UserHistory:Create');

            Route::match(['POST'], '/', [
                UserHistoryController::class, 'store'
            ])->name('store')->middleware('permission:Cms:UserHistory:Create');

            Route::prefix('{userHistory}')->group(function() {
                Route::match(['GET', 'HEAD'], '/', [
                    UserHistoryController::class, 'show'
                ])->name('show')->middleware('permission:Cms:UserHistory:View');

                Route::match(['GET', 'HEAD'], '/edit', [
                    UserHistoryController::class, 'edit'
                ])->name('edit')->middleware('permission:Cms:UserHistory:Update');

                Route::match(['PUT', 'PATCH'], '/', [
                    UserHistoryController::class, 'update'
                ])->name('update')->middleware('permission:Cms:UserHistory:Update');

                Route::match(['DELETE'], '/', [
                    UserHistoryController::class, 'destroy'
                ])->name('destroy')->middleware('permission:Cms:UserHistory:Delete');
            });
        });

        Route::prefix('forms')->name('forms.')->group(function() {
            Route::match(['GET', 'HEAD'], '/', [
                FormController::class, 'index'
            ])->name('index')->middleware('permission:Cms:Form:Index');

            Route::match(['GET', 'HEAD'], '/create', [
                FormController::class, 'create'
            ])->name('create')->middleware('permission:Cms:Form:Create');

            Route::match(['POST'], '/', [
                FormController::class, 'store'
            ])->name('store')->middleware('permission:Cms:Form:Create');

            Route::prefix('{form}')->group(function() {
                Route::match(['GET', 'HEAD'], '/', [
                    FormController::class, 'show'
                ])->name('show')->middleware('permission:Cms:Form:View');

                Route::match(['GET', 'HEAD'], '/edit', [
                    FormController::class, 'edit'
                ])->name('edit')->middleware('permission:Cms:Form:Update');

                Route::match(['PUT', 'PATCH'], '/', [
                    FormController::class, 'update'
                ])->name('update')->middleware('permission:Cms:Form:Update');

                Route::match(['DELETE'], '/', [
                    FormController::class, 'destroy'
                ])->name('destroy')->middleware('permission:Cms:Form:Delete');
            });
        });

        Route::prefix('inputs')->name('inputs.')->group(function() {
            Route::match(['GET', 'HEAD'], '/', [
                InputController::class, 'index'
            ])->name('index')->middleware('permission:Cms:Input:Index');

            Route::match(['GET', 'HEAD'], '/create', [
                InputController::class, 'create'
            ])->name('create')->middleware('permission:Cms:Input:Create');

            Route::match(['POST'], '/', [
                InputController::class, 'store'
            ])->name('store')->middleware('permission:Cms:Input:Create');

            Route::prefix('{input}')->group(function() {
                Route::match(['GET', 'HEAD'], '/', [
                    InputController::class, 'show'
                ])->name('show')->middleware('permission:Cms:Input:View');

                Route::match(['GET', 'HEAD'], '/edit', [
                    InputController::class, 'edit'
                ])->name('edit')->middleware('permission:Cms:Input:Update');

                Route::match(['PUT', 'PATCH'], '/', [
                    InputController::class, 'update'
                ])->name('update')->middleware('permission:Cms:Input:Update');

                Route::match(['DELETE'], '/', [
                    InputController::class, 'destroy'
                ])->name('destroy')->middleware('permission:Cms:Input:Delete');
            });
        });

        Route::prefix('languages')->name('languages.')->group(function() {
            Route::match(['GET', 'HEAD'], '/', [
                LanguageController::class, 'index'
            ])->name('index')->middleware('permission:Cms:Language:Index');

            Route::match(['GET', 'HEAD'], '/create', [
                LanguageController::class, 'create'
            ])->name('create')->middleware('permission:Cms:Language:Create');

            Route::match(['POST'], '/', [
                LanguageController::class, 'store'
            ])->name('store')->middleware('permission:Cms:Language:Create');

            Route::prefix('{language}')->group(function() {
                Route::match(['GET', 'HEAD'], '/', [
                    LanguageController::class, 'show'
                ])->name('show')->middleware('permission:Cms:Language:View');

                Route::match(['GET', 'HEAD'], '/edit', [
                    LanguageController::class, 'edit'
                ])->name('edit')->middleware('permission:Cms:Language:Update');

                Route::match(['PUT', 'PATCH'], '/', [
                    LanguageController::class, 'update'
                ])->name('update')->middleware('permission:Cms:Language:Update');

                Route::match(['DELETE'], '/', [
                    LanguageController::class, 'destroy'
                ])->name('destroy')->middleware('permission:Cms:Language:Delete');
            });
        });

        Route::prefix('blocks')->name('blocks.')->group(function() {
            Route::match(['GET', 'HEAD'], '/', [
                BlockController::class, 'index'
            ])->name('index')->middleware('permission:Cms:Block:Index');

            Route::match(['GET', 'HEAD'], '/create', [
                BlockController::class, 'create'
            ])->name('create')->middleware('permission:Cms:Block:Create');

            Route::match(['POST'], '/', [
                BlockController::class, 'store'
            ])->name('store')->middleware('permission:Cms:Block:Create');

            Route::prefix('{block}')->group(function() {
                Route::match(['GET', 'HEAD'], '/', [
                    BlockController::class, 'show'
                ])->name('show')->middleware('permission:Cms:Block:View');

                Route::match(['GET', 'HEAD'], '/edit', [
                    BlockController::class, 'edit'
                ])->name('edit')->middleware('permission:Cms:Block:Update');

                Route::match(['PUT', 'PATCH'], '/', [
                    BlockController::class, 'update'
                ])->name('update')->middleware('permission:Cms:Block:Update');

                Route::match(['DELETE'], '/', [
                    BlockController::class, 'destroy'
                ])->name('destroy')->middleware('permission:Cms:Block:Delete');
            });
        });

        Route::prefix('file-management')->name('file-management.')->group(function() {
            Route::match(['GET', 'HEAD'], '/', [
                FileManagementController::class, 'index'
            ])->name('index')->middleware('permission:Cms:FileManagement:Index');

            Route::prefix('dir')->name('dir.')->group(function () {
                Route::match(['POST'], '/', [
                    FileManagementDirController::class, 'store'
                ])->name('store')->middleware('permission:Cms:FileManagement:Create');

                Route::match(['DELETE'], '/', [
                    FileManagementDirController::class, 'destroy'
                ])->name('destroy')->middleware('permission:Cms:FileManagement:Delete');
            });

            Route::prefix('file')->name('file.')->group(function () {
                Route::match(['GET', 'HEAD'], '/', [
                    FileManagementFileController::class, 'show'
                ])->name('show')->middleware('permission:Cms:FileManagement:View');

                Route::match(['POST'], '/', [
                    FileManagementFileController::class, 'store'
                ])->name('store')->middleware('permission:Cms:FileManagement:Create');

                Route::match(['DELETE'], '/', [
                    FileManagementFileController::class, 'destroy'
                ])->name('destroy')->middleware('permission:Cms:FileManagement:Delete');
            });
        });

        Route::prefix('modules')->name('modules.')->group(function() {
            Route::match(['GET', 'HEAD'], '/', [
                ModuleController::class, 'index'
            ])->name('index')->middleware('permission:Cms:Module:Index');

            Route::match(['GET', 'HEAD'], '/create', [
                ModuleController::class, 'create'
            ])->name('create')->middleware('permission:Cms:Module:Create');

            Route::match(['POST'], '/', [
                ModuleController::class, 'store'
            ])->name('store')->middleware('permission:Cms:Module:Create');

            Route::prefix('{module}')->group(function() {
                Route::match(['GET', 'HEAD'], '/', [
                    ModuleController::class, 'show'
                ])->name('show')->middleware('permission:Cms:Module:View');

                Route::match(['GET', 'HEAD'], '/edit', [
                    ModuleController::class, 'edit'
                ])->name('edit')->middleware('permission:Cms:Module:Update');

                Route::match(['PUT', 'PATCH'], '/', [
                    ModuleController::class, 'update'
                ])->name('update')->middleware('permission:Cms:Module:Update');

                Route::match(['DELETE'], '/', [
                    ModuleController::class, 'destroy'
                ])->name('destroy')->middleware('permission:Cms:Module:Delete');

                Route::prefix('module-columns')->name('module-columns.')->group(function() {
                    Route::match(['GET', 'HEAD'], '/', [
                        ModuleColumnController::class, 'index'
                    ])->name('index')->middleware('permission:Cms:Module:Index');

                    Route::match(['GET', 'HEAD'], '/create', [
                        ModuleColumnController::class, 'create'
                    ])->name('create')->middleware('permission:Cms:Module:Create');

                    Route::match(['POST'], '/', [
                        ModuleColumnController::class, 'store'
                    ])->name('store')->middleware('permission:Cms:Module:Create');

                    Route::prefix('{moduleColumn}')->group(function() {
                        Route::match(['GET', 'HEAD'], '/', [
                            ModuleColumnController::class, 'show'
                        ])->name('show')->middleware('permission:Cms:Module:View');

                        Route::match(['GET', 'HEAD'], '/edit', [
                            ModuleColumnController::class, 'edit'
                        ])->name('edit')->middleware('permission:Cms:Module:Update');

                        Route::match(['PUT', 'PATCH'], '/', [
                            ModuleColumnController::class, 'update'
                        ])->name('update')->middleware('permission:Cms:Module:Update');

                        Route::match(['DELETE'], '/', [
                            ModuleColumnController::class, 'destroy'
                        ])->name('destroy')->middleware('permission:Cms:Module:Delete');
                    });
                });

                Route::prefix('module-templates')->name('module-templates.')->group(function() {
                    Route::match(['GET', 'HEAD'], '/', [
                        ModuleTemplateController::class, 'index'
                    ])->name('index')->middleware('permission:Cms:Module:Index');

                    Route::match(['GET', 'HEAD'], '/create', [
                        ModuleTemplateController::class, 'create'
                    ])->name('create')->middleware('permission:Cms:Module:Create');

                    Route::match(['POST'], '/', [
                        ModuleTemplateController::class, 'store'
                    ])->name('store')->middleware('permission:Cms:Module:Create');

                    Route::prefix('{moduleTemplate}')->group(function() {
                        Route::match(['GET', 'HEAD'], '/', [
                            ModuleTemplateController::class, 'show'
                        ])->name('show')->middleware('permission:Cms:Module:View');

                        Route::match(['GET', 'HEAD'], '/edit', [
                            ModuleTemplateController::class, 'edit'
                        ])->name('edit')->middleware('permission:Cms:Module:Update');

                        Route::match(['PUT', 'PATCH'], '/', [
                            ModuleTemplateController::class, 'update'
                        ])->name('update')->middleware('permission:Cms:Module:Update');

                        Route::match(['DELETE'], '/', [
                            ModuleTemplateController::class, 'destroy'
                        ])->name('destroy')->middleware('permission:Cms:Module:Delete');
                    });
                });

                Route::prefix('module-database')->name('module-database.')->group(function() {
                    Route::match(['GET', 'HEAD'], '/', [
                        ModuleDatabaseController::class, 'index'
                    ])->name('index')->middleware('permission:Cms:Module:Index');

                    Route::match(['GET', 'HEAD'], '/create', [
                        ModuleDatabaseController::class, 'create'
                    ])->name('create')->middleware('permission:Cms:Module:Create');

                    Route::match(['POST'], '/', [
                        ModuleDatabaseController::class, 'store'
                    ])->name('store')->middleware('permission:Cms:Module:Create');

                    Route::match(['DELETE'], '/drop', [
                        ModuleDatabaseController::class, 'drop'
                    ])->name('drop')->middleware('permission:Cms:Module:Delete');

                    Route::prefix('{moduleDatabase}')->group(function() {
                        Route::match(['GET', 'HEAD'], '/', [
                            ModuleDatabaseController::class, 'show'
                        ])->name('show')->middleware('permission:Cms:Module:View');

                        Route::match(['GET', 'HEAD'], '/edit', [
                            ModuleDatabaseController::class, 'edit'
                        ])->name('edit')->middleware('permission:Cms:Module:Update');

                        Route::match(['PUT', 'PATCH'], '/', [
                            ModuleDatabaseController::class, 'update'
                        ])->name('update')->middleware('permission:Cms:Module:Update');

                        Route::match(['DELETE'], '/', [
                            ModuleDatabaseController::class, 'destroy'
                        ])->name('destroy')->middleware('permission:Cms:Module:Delete');
                    });
                });
            });
        });

        Route::prefix('web-data')->name('web-data.')->group(function() {
            Route::match(['GET', 'HEAD'], '/', [
                WebDataController::class, 'index'
            ])->name('index')->middleware('permission:Cms:WebData:Index');

            Route::match(['POST'], '/csv', [
                WebDataController::class, 'csv'
            ])->name('csv')->middleware('permission:Cms:WebData:Export');

            Route::match(['POST'], '/xlsx', [
                WebDataController::class, 'xlsx'
            ])->name('xlsx')->middleware('permission:Cms:WebData:Export');

            Route::prefix('{webData}')->group(function() {
                Route::match(['GET', 'HEAD'], '/', [
                    WebDataController::class, 'show'
                ])->name('show')->middleware('permission:Cms:WebData:View');

                Route::match(['DELETE'], '/', [
                    WebDataController::class, 'destroy'
                ])->name('destroy')->middleware('permission:Cms:WebData:Delete');
            });
        });

        Route::prefix('web-sites')->name('web-sites.')->group(function() {
            Route::match(['GET', 'HEAD'], '/', [
                WebSiteController::class, 'index'
            ])->name('index')->middleware('permission:Cms:WebSite:Index');

            Route::match(['GET', 'HEAD'], '/create', [
                WebSiteController::class, 'create'
            ])->name('create')->middleware('permission:Cms:WebSite:Create');

            Route::match(['POST'], '/', [
                WebSiteController::class, 'store'
            ])->name('store')->middleware('permission:Cms:WebSite:Create');

            Route::prefix('{webSite}')->group(function() {
                Route::match(['GET', 'HEAD'], '/', [
                    WebSiteController::class, 'show'
                ])->name('show')->middleware('permission:Cms:WebSite:View');

                Route::match(['GET', 'HEAD'], '/edit', [
                    WebSiteController::class, 'edit'
                ])->name('edit')->middleware('permission:Cms:WebSite:Update');

                Route::match(['PUT', 'PATCH'], '/', [
                    WebSiteController::class, 'update'
                ])->name('update')->middleware('permission:Cms:WebSite:Update');

                Route::match(['GET', 'HEAD'], '/letsencrypt', [
                    WebSiteController::class, 'letsencrypt'
                ])->name('letsencrypt')->middleware('permission:Cms:WebSite:Update');

                Route::match(['DELETE'], '/', [
                    WebSiteController::class, 'destroy'
                ])->name('destroy')->middleware('permission:Cms:WebSite:Delete');

                Route::prefix('copy')->name('copy.')->group(function() {
                    Route::match(['GET', 'HEAD'], '/', [
                        WebSiteCopyController::class, 'index'
                    ])->name('index')->middleware('permission:Cms:WebSite:Copy');

                    Route::match(['POST'], '/', [
                        WebSiteCopyController::class, 'store'
                    ])->name('store')->middleware('permission:Cms:WebSite:Copy');
                });

                Route::prefix('code')->name('code.')->group(function() {
                    Route::match(['GET', 'HEAD'], '/', [
                        WebSiteCodeController::class, 'index'
                    ])->name('index')->middleware('permission:Cms:WebSite:Code');

                    Route::match(['PUT', 'PATCH'], '/', [
                        WebSiteCodeController::class, 'update'
                    ])->name('update')->middleware('permission:Cms:WebSite:Code');
                });

                Route::prefix('web-robber')->name('web-robber.')->group(function() {
                    Route::match(['GET', 'HEAD'], '/', [
                        WebRobberController::class, 'index'
                    ])->name('index')->middleware('permission:Cms:WebPage:Create');

                    Route::match(['POST'], '/', [
                        WebRobberController::class, 'store'
                    ])->name('store')->middleware('permission:Cms:WebPage:Create');
                });

                Route::prefix('web-resources')->name('web-resources.')->group(function() {
                    Route::match(['GET', 'HEAD'], '/', [
                        WebResourceController::class, 'index'
                    ])->name('index')->middleware('permission:Cms:WebResource:Index');

                    Route::match(['GET', 'HEAD'], '/create', [
                        WebResourceController::class, 'create'
                    ])->name('create')->middleware('permission:Cms:WebResource:Create');

                    Route::match(['POST'], '/', [
                        WebResourceController::class, 'store'
                    ])->name('store')->middleware('permission:Cms:WebResource:Create');

                    Route::match(['POST'], '/position', [
                        WebResourceController::class, 'position'
                    ])->name('position')->middleware('permission:Cms:WebResource:Update');

                    Route::prefix('{webResource}')->group(function() {
                        Route::match(['DELETE'], '/', [
                            WebResourceController::class, 'destroy'
                        ])->name('destroy')->middleware('permission:Cms:WebResource:Delete');
                    });
                });

                Route::prefix('web-variables')->name('web-variables.')->group(function() {
                    Route::match(['GET', 'HEAD'], '/', [
                        WebVariableController::class, 'index'
                    ])->name('index')->middleware('permission:Cms:WebVariable:Index');

                    Route::match(['GET', 'HEAD'], '/create', [
                        WebVariableController::class, 'create'
                    ])->name('create')->middleware('permission:Cms:WebVariable:Create');

                    Route::match(['POST'], '/', [
                        WebVariableController::class, 'store'
                    ])->name('store')->middleware('permission:Cms:WebVariable:Create');

                    Route::prefix('{webVariable}')->group(function() {
                        Route::match(['GET', 'HEAD'], '/', [
                            WebVariableController::class, 'show'
                        ])->name('show')->middleware('permission:Cms:WebVariable:View');

                        Route::match(['GET', 'HEAD'], '/edit', [
                            WebVariableController::class, 'edit'
                        ])->name('edit')->middleware('permission:Cms:WebVariable:Update');

                        Route::match(['PUT', 'PATCH'], '/', [
                            WebVariableController::class, 'update'
                        ])->name('update')->middleware('permission:Cms:WebVariable:Update');

                        Route::match(['DELETE'], '/', [
                            WebVariableController::class, 'destroy'
                        ])->name('destroy')->middleware('permission:Cms:WebVariable:Delete');
                    });
                });

                Route::prefix('web-breadcrumbs')->name('web-breadcrumbs.')->group(function() {
                    Route::match(['GET', 'HEAD'], '/', [
                        WebBreadcrumbController::class, 'index'
                    ])->name('index')->middleware('permission:Cms:WebBreadcrumb:Index');

                    Route::match(['GET', 'HEAD'], '/create', [
                        WebBreadcrumbController::class, 'create'
                    ])->name('create')->middleware('permission:Cms:WebBreadcrumb:Create');

                    Route::match(['POST'], '/', [
                        WebBreadcrumbController::class, 'store'
                    ])->name('store')->middleware('permission:Cms:WebBreadcrumb:Create');

                    Route::prefix('{webBreadcrumb}')->group(function() {
                        Route::match(['GET', 'HEAD'], '/', [
                            WebBreadcrumbController::class, 'show'
                        ])->name('show')->middleware('permission:Cms:WebBreadcrumb:View');

                        Route::match(['GET', 'HEAD'], '/edit', [
                            WebBreadcrumbController::class, 'edit'
                        ])->name('edit')->middleware('permission:Cms:WebBreadcrumb:Update');

                        Route::match(['PUT', 'PATCH'], '/', [
                            WebBreadcrumbController::class, 'update'
                        ])->name('update')->middleware('permission:Cms:WebBreadcrumb:Update');

                        Route::match(['DELETE'], '/', [
                            WebBreadcrumbController::class, 'destroy'
                        ])->name('destroy')->middleware('permission:Cms:WebBreadcrumb:Delete');
                    });
                });

                Route::prefix('web-paginations')->name('web-paginations.')->group(function() {
                    Route::match(['GET', 'HEAD'], '/', [
                        WebPaginationController::class, 'index'
                    ])->name('index')->middleware('permission:Cms:WebPagination:Index');

                    Route::match(['GET', 'HEAD'], '/create', [
                        WebPaginationController::class, 'create'
                    ])->name('create')->middleware('permission:Cms:WebPagination:Create');

                    Route::match(['POST'], '/', [
                        WebPaginationController::class, 'store'
                    ])->name('store')->middleware('permission:Cms:WebPagination:Create');

                    Route::prefix('{webPagination}')->group(function() {
                        Route::match(['GET', 'HEAD'], '/', [
                            WebPaginationController::class, 'show'
                        ])->name('show')->middleware('permission:Cms:WebPagination:View');

                        Route::match(['GET', 'HEAD'], '/edit', [
                            WebPaginationController::class, 'edit'
                        ])->name('edit')->middleware('permission:Cms:WebPagination:Update');

                        Route::match(['PUT', 'PATCH'], '/', [
                            WebPaginationController::class, 'update'
                        ])->name('update')->middleware('permission:Cms:WebPagination:Update');

                        Route::match(['DELETE'], '/', [
                            WebPaginationController::class, 'destroy'
                        ])->name('destroy')->middleware('permission:Cms:WebPagination:Delete');
                    });
                });

                Route::prefix('web-blocks')->name('web-blocks.')->group(function() {
                    Route::match(['GET', 'HEAD'], '/', [
                        WebBlockController::class, 'index'
                    ])->name('index')->middleware('permission:Cms:WebBlock:Index');

                    Route::match(['GET', 'HEAD'], '/create', [
                        WebBlockController::class, 'create'
                    ])->name('create')->middleware('permission:Cms:WebBlock:Create');

                    Route::match(['POST'], '/', [
                        WebBlockController::class, 'store'
                    ])->name('store')->middleware('permission:Cms:WebBlock:Create');

                    Route::prefix('{webBlock}')->group(function() {
                        Route::match(['GET', 'HEAD'], '/', [
                            WebBlockController::class, 'show'
                        ])->name('show')->middleware('permission:Cms:WebBlock:View');

                        Route::match(['GET', 'HEAD'], '/edit', [
                            WebBlockController::class, 'edit'
                        ])->name('edit')->middleware('permission:Cms:WebBlock:Update');

                        Route::match(['PUT', 'PATCH'], '/', [
                            WebBlockController::class, 'update'
                        ])->name('update')->middleware('permission:Cms:WebBlock:Update');

                        Route::match(['DELETE'], '/', [
                            WebBlockController::class, 'destroy'
                        ])->name('destroy')->middleware('permission:Cms:WebBlock:Delete');
                    });
                });

                Route::prefix('web-menu')->name('web-menu.')->group(function() {
                    Route::match(['GET', 'HEAD'], '/', [
                        WebMenuController::class, 'index'
                    ])->name('index')->middleware('permission:Cms:WebMenu:Index');

                    Route::match(['GET', 'HEAD'], '/create', [
                        WebMenuController::class, 'create'
                    ])->name('create')->middleware('permission:Cms:WebMenu:Create');

                    Route::match(['POST'], '/', [
                        WebMenuController::class, 'store'
                    ])->name('store')->middleware('permission:Cms:WebMenu:Create');

                    Route::prefix('{webMenu}')->group(function() {
                        Route::match(['GET', 'HEAD'], '/', [
                            WebMenuController::class, 'show'
                        ])->name('show')->middleware('permission:Cms:WebMenu:View');

                        Route::match(['GET', 'HEAD'], '/edit', [
                            WebMenuController::class, 'edit'
                        ])->name('edit')->middleware('permission:Cms:WebMenu:Update');

                        Route::match(['PUT', 'PATCH'], '/', [
                            WebMenuController::class, 'update'
                        ])->name('update')->middleware('permission:Cms:WebMenu:Update');

                        Route::match(['DELETE'], '/', [
                            WebMenuController::class, 'destroy'
                        ])->name('destroy')->middleware('permission:Cms:WebMenu:Delete');

                        Route::prefix('web-menu-items')->name('web-menu-items.')->group(function() {
                            Route::match(['GET', 'HEAD'], '/', [
                                WebMenuItemController::class, 'index'
                            ])->name('index')->middleware('permission:Cms:WebMenu:Index');

                            Route::match(['GET', 'HEAD'], '/create', [
                                WebMenuItemController::class, 'create'
                            ])->name('create')->middleware('permission:Cms:WebMenu:Create');

                            Route::match(['POST'], '/', [
                                WebMenuItemController::class, 'store'
                            ])->name('store')->middleware('permission:Cms:WebMenu:Create');

                            Route::match(['POST'], '/position', [
                                WebMenuItemController::class, 'position'
                            ])->name('position')->middleware('permission:Cms:WebMenu:Update');

                            Route::prefix('{webMenuItem}')->group(function() {
                                Route::match(['GET', 'HEAD'], '/', [
                                    WebMenuItemController::class, 'show'
                                ])->name('show')->middleware('permission:Cms:WebMenu:View');

                                Route::match(['GET', 'HEAD'], '/edit', [
                                    WebMenuItemController::class, 'edit'
                                ])->name('edit')->middleware('permission:Cms:WebMenu:Update');

                                Route::match(['PUT', 'PATCH'], '/', [
                                    WebMenuItemController::class, 'update'
                                ])->name('update')->middleware('permission:Cms:WebMenu:Update');

                                Route::match(['DELETE'], '/', [
                                    WebMenuItemController::class, 'destroy'
                                ])->name('destroy')->middleware('permission:Cms:WebMenu:Delete');
                            });
                        });

                        Route::prefix('web-menu-templates')->name('web-menu-templates.')->group(function() {
                            Route::match(['GET', 'HEAD'], '/', [
                                WebMenuTemplateController::class, 'index'
                            ])->name('index')->middleware('permission:Cms:WebMenu:Index');

                            Route::match(['GET', 'HEAD'], '/create', [
                                WebMenuTemplateController::class, 'create'
                            ])->name('create')->middleware('permission:Cms:WebMenu:Create');

                            Route::match(['POST'], '/', [
                                WebMenuTemplateController::class, 'store'
                            ])->name('store')->middleware('permission:Cms:WebMenu:Create');

                            Route::match(['POST'], '/position', [
                                WebMenuTemplateController::class, 'position'
                            ])->name('position')->middleware('permission:Cms:WebMenu:Update');

                            Route::prefix('{webMenuTemplate}')->group(function() {
                                Route::match(['GET', 'HEAD'], '/', [
                                    WebMenuTemplateController::class, 'show'
                                ])->name('show')->middleware('permission:Cms:WebMenu:View');

                                Route::match(['GET', 'HEAD'], '/edit', [
                                    WebMenuTemplateController::class, 'edit'
                                ])->name('edit')->middleware('permission:Cms:WebMenu:Update');

                                Route::match(['PUT', 'PATCH'], '/', [
                                    WebMenuTemplateController::class, 'update'
                                ])->name('update')->middleware('permission:Cms:WebMenu:Update');

                                Route::match(['DELETE'], '/', [
                                    WebMenuTemplateController::class, 'destroy'
                                ])->name('destroy')->middleware('permission:Cms:WebMenu:Delete');
                            });
                        });
                    });
                });

                Route::prefix('web-pages')->name('web-pages.')->group(function() {
                    Route::match(['GET', 'HEAD'], '/', [
                        WebPageController::class, 'index'
                    ])->name('index')->middleware('permission:Cms:WebPage:Index');

                    Route::match(['GET', 'HEAD'], '/create', [
                        WebPageController::class, 'create'
                    ])->name('create')->middleware('permission:Cms:WebPage:Create');

                    Route::match(['POST'], '/', [
                        WebPageController::class, 'store'
                    ])->name('store')->middleware('permission:Cms:WebPage:Create');

                    Route::prefix('{webPage}')->group(function() {
                        Route::match(['GET', 'HEAD'], '/', [
                            WebPageController::class, 'show'
                        ])->name('show')->middleware('permission:Cms:WebPage:View');

                        Route::match(['GET', 'HEAD'], '/edit', [
                            WebPageController::class, 'edit'
                        ])->name('edit')->middleware('permission:Cms:WebPage:Update');

                        Route::match(['PUT', 'PATCH'], '/', [
                            WebPageController::class, 'update'
                        ])->name('update')->middleware('permission:Cms:WebPage:Update');

                        Route::match(['DELETE'], '/', [
                            WebPageController::class, 'destroy'
                        ])->name('destroy')->middleware('permission:Cms:WebPage:Delete');

                        Route::prefix('copy')->name('copy.')->group(function() {
                            Route::match(['GET', 'HEAD'], '/', [
                                WebPageCopyController::class, 'index'
                            ])->name('index')->middleware('permission:Cms:WebPage:Copy');

                            Route::match(['POST'], '/', [
                                WebPageCopyController::class, 'store'
                            ])->name('store')->middleware('permission:Cms:WebPage:Copy');
                        });

                        Route::prefix('versions')->name('versions.')->group(function() {
                            Route::match(['GET', 'HEAD'], '/', [
                                WebPageLanguageVersionController::class, 'index'
                            ])->name('index')->middleware('permission:Cms:WebPage:Index');

                            Route::prefix('{webPageLanguageVersion}')->group(function() {
                                Route::match(['GET', 'HEAD'], '/', [
                                    WebPageLanguageVersionController::class, 'show'
                                ])->name('show')->middleware('permission:Cms:WebPage:View');

                                Route::match(['PUT', 'PATCH'], '/restore', [
                                    WebPageLanguageVersionController::class, 'restore'
                                ])->name('restore')->middleware('permission:Cms:WebPage:Update');
                            });
                        });
                    });
                });

                Route::prefix('web-page-templates')->name('web-page-templates.')->group(function() {
                    Route::match(['GET', 'HEAD'], '/', [
                        WebPageTemplateController::class, 'index'
                    ])->name('index')->middleware('permission:Cms:WebPageTemplate:Index');

                    Route::match(['GET', 'HEAD'], '/create', [
                        WebPageTemplateController::class, 'create'
                    ])->name('create')->middleware('permission:Cms:WebPageTemplate:Create');

                    Route::match(['POST'], '/', [
                        WebPageTemplateController::class, 'store'
                    ])->name('store')->middleware('permission:Cms:WebPageTemplate:Create');

                    Route::prefix('{webPageTemplate}')->group(function() {
                        Route::match(['GET', 'HEAD'], '/', [
                            WebPageTemplateController::class, 'show'
                        ])->name('show')->middleware('permission:Cms:WebPageTemplate:View');

                        Route::match(['GET', 'HEAD'], '/edit', [
                            WebPageTemplateController::class, 'edit'
                        ])->name('edit')->middleware('permission:Cms:WebPageTemplate:Update');

                        Route::match(['PUT', 'PATCH'], '/', [
                            WebPageTemplateController::class, 'update'
                        ])->name('update')->middleware('permission:Cms:WebPageTemplate:Update');

                        Route::match(['DELETE'], '/', [
                            WebPageTemplateController::class, 'destroy'
                        ])->name('destroy')->middleware('permission:Cms:WebPageTemplate:Delete');
                    });
                });
            });
        });
    });
});
