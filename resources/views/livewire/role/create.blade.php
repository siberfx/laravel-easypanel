<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('CreateTitle', ['name' => __('Role') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded" style="background-color: #e9ecef!important;">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.role.lists')" class="text-decoration-none">{{ __('Role') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" x-data="{}" wire:submit.prevent="create" autocomplete="off">

        <div class="card-body">
            <div class="row ">

                <div class="col-md-6">
                    <div class="form-group">
                        <input id="route" type="text" placeholder="{{ __('Name Of Role') }}" class="form-control rounded @error('name') is-invalid @enderror" wire:model="name">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-check text-left col-md-4">
                            <input type="checkbox" class="form-check-input"
                                    id="permission_check_fullAccess"
                                    wire:model="access.fullAccess"
                                    value="1">

                            <label class='form-check-label' for="permission_check_fullAccess">{{__('Full Access')}}</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3" dir="ltr">
                @foreach($permissions as $key => $value)
                @php
                    $dashKey = str_replace('.', '-', $key);
                    $entityName = strpos($key, 'admin.') !== false ? ucfirst(str_replace('admin.', '', $key)) : ucfirst($key);
                @endphp
                <div class="col-md-4 col-sm-12">
                    <div class="card text-left">
                        
                        <div class="row mt-3 ml-1">
                            <div class="col-10"><h4>{{ __($entityName) }}</h4></div>
    
                            <div class="form-check text-center col-md-1 ml-3">
                                <input type="checkbox" class="form-check-input" wire:model="selectAll.{{$dashKey}}">
                            </div>
                        </div>
                        <!-- /card header -->

                        <hr style="width:98%;">

                        <div class="card-body row" style="height: 140px;">
                            @foreach($value as $keyAccess)
                            <div class="form-check col-md-11">
                                <label class='form-check-label' for="permission_check_{{$dashKey}}_{{$keyAccess['name']}}">{{ __($keyAccess['name']) }}</label>
                            </div>

                            <div class="form-check col-md-1">
                                <input type="checkbox" class="form-check-input" id="permission_check_{{$dashKey}}_{{$keyAccess['name']}}" {{($selectAll[$dashKey] ?? false) ? 'checked' : ''}} wire:model="access.{{$dashKey}}.{{$keyAccess['name']}}" value="1">
                            </div>
                            @endforeach
                            <div class="form-check col-md-11">
                                <label class='form-check-label' for="permission_check_{{$dashKey}}_delete">{{__('delete')}}</label>
                            </div>

                            <div class="form-check col-md-1">
                                <input type="checkbox" class="form-check-input" {{($selectAll[$dashKey] ?? false) ? 'checked' : ''}} id="permission_check_{{$dashKey}}_delete" wire:model="access.{{$dashKey}}.delete" value="1">
                            </div>
                        </div>
                        <!-- /card-body -->
                    </div>
                </div>
                <!-- /col-md-4 -->
                @endforeach
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Create') }}</button>
            <a href="@route(getRouteName().'.role.lists')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>

</div>
