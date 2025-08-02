@extends('layouts._admin.base')

@section('content')
<!-- Add this in your <head> for testing -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <a class="searcha"><i class="pe-7s-search searchicon"></i><input type="text" id="search" value=""
            style="height:20px;" /></a>

    <article>
        <div id="page_control">
            {{-- <div class="col2">
         <a href="{{url('dnradmin/manager/new')}}"><img src="{{url('_admin/assets/images/icons/icon_add.png')}}"> Add new {{ SALESMANAGER_MANAGEMENT }}</a>
        </div> --}}
            <div class="col1">
                {{ $pageTitle }}
            </div>

        </div>



        <br style="clear:both;" />
        <input type='hidden' id='current_page' />
        <input type='hidden' id='show_per_page' />
        <input type='hidden' id='number_of_items' />


        {!! Form::open(['url' => '/dnradmin/affiliate/', 'method' => 'post', 'id' => 'pageform', 'files' => true]) !!}

       <div class="overflow-x-auto rounded-lg shadow-md">
            <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-200">
                <thead class="text-xs font-semibold uppercase bg-gray-100 text-gray-600 border-b">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email Address</th>
                        <th class="px-4 py-3">Contact No</th>
                        <th class="px-4 py-3">Promo Code</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">{{ date('Y') }} Commission</th>
                        <th class="px-4 py-3">Manager Name</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($managers as $manager)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $manager->fldManagerID }}</td>
                            <td class="px-4 py-3">{{ $manager->fldManagerFirstname }} {{ $manager->fldManagerLastname }}</td>
                            <td class="px-4 py-3">{{ $manager->fldManagerEmail }}</td>
                            <td class="px-4 py-3">{{ $manager->fldManagerPhoneNo }}</td>
                            <td class="px-4 py-3">{{ $manager->fldManagerPromoCode }}</td>
                            <td class="px-4 py-3">
                                @if ($manager->fldManagerStatus == 1)
                                    <span class="text-red-600 font-semibold">Pending</span>
                                @else
                                    <span class="text-green-600 font-semibold">Active</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-blue-600 font-medium">
                                <a href="{{ url('/dnradmin/manager/sales/' . $manager->fldManagerID) }}">
                                    {{ number_format($manager->fldManagerCommission, 2) }}
                                </a>
                            </td>
                            <td class="px-4 py-3 text-gray-700">{{ $manager->mainManagerName }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-gray-500">No Record Found</td>
                        </tr>
                    @endforelse
                </tbody>

                @if (!$managers->isEmpty())
                    <tfoot>
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-right bg-gray-50">
                                <div class="inline-flex items-center gap-2 text-sm text-gray-600">
                                    {{-- Custom pagination if needed --}}
                                    <span class="font-semibold">Prev</span>
                                    <span class="px-3 py-1 rounded bg-black text-white">1</span>
                                    <span class="font-semibold">Next</span>
                                </div>
                            </td>
                        </tr>
                    @endif
            </table>
      </div>


        {!! Form::close() !!}
    </article>


@stop

@section('headercodes')
    {!! Html::style('_admin/assets/css/pagination.css') !!}
@stop

@section('extracodes')

    {!! Html::script('_admin/manager/tinymce/tiny_mce.js') !!}
    {!! Html::script('_admin/assets/js/cufon_avantgarde.js') !!}
    {!! Html::script('_admin/assets/js/jquery-latest.min.js') !!}
    {!! Html::script('_admin/assets/js/FilterPagination/filter.js') !!}
    {!! Html::script('_admin/manager/tinymce/styles/mods2.js') !!}
    {!! Html::script('_admin/assets/js/jquery.tablednd.js') !!}
    {!! Html::script('_admin/assets/js/stupidtable.min.js') !!}
    {!! Html::script('_admin/assets/js/sorted.js') !!}

    <script>
        showPagination(20, $('#page_manager tbody>tr').size(), $('#page_manager tbody>tr'));
    </script>

@stop
