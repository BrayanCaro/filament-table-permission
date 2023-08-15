<?php

namespace BrayanCaro\FilamentTablePermission\Tables\Actions\Roles;

use Filament\Forms\Components\Field;
use Filament\Forms\Components\Select;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

class SyncRolesBulkAction extends BulkAction
{
    use CanCustomizeProcess;

    protected string $LANG_NAMESPACE = 'filament-table-permission::actions';

    public static function getDefaultName(): ?string
    {
        return 'sync-roles';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__("$this->LANG_NAMESPACE.roles.sync.label"));

        $this->modalHeading(__("$this->LANG_NAMESPACE.roles.sync.modal.heading"));

        $this->modalButton(__("$this->LANG_NAMESPACE.roles.sync.modal.actions.confirm.label"));

        $this->successNotificationTitle(__("$this->LANG_NAMESPACE.roles.sync.messages.synced"));

        $this->icon('heroicon-o-sparkles');

        $this->form([$this->getSelectField()])->deselectRecordsAfterCompletion();

        $this->action(function (): void {
            $this->process(
                static function (Collection $records, array $data): void {
                    foreach ($records as $record) {
                        $record->roles()->sync($data['roleId']);
                    }
                }
            );

            $this->success();
        });
    }

    protected function getSelectField(): Field
    {
        return Select::make('roleId')->label(__("$this->LANG_NAMESPACE.roles.sync.field.label"))
            ->options(Role::query()->pluck('name', 'id'))
            ->required();
    }
}
