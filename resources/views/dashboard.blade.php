<x-app-layout>
    <x-slot name="header">
        <div class="row">
                <a href="/category" class="col-sm-4 d-flex flex-column align-items-center justify-items-center">
                    <i class="fa fa-cog fa-5x text-danger"></i>
                    Manage
                </a>
                <a href="/payment" class="col-sm-4 d-flex flex-column align-items-center justify-items-center">
                    <i class="fa fa-shopping-bag fa-5x text-primary"></i>
                    Sales
                </a>
                <a href="/report" class="col-sm-4 d-flex flex-column align-items-center justify-items-center">
                    <i class="fa fa-clipboard-list fa-5x text-success"></i>
                    Reports
                </a>
        </div>
    </x-slot>
</x-app-layout>
