<?php

namespace BrayanCaro\FilamentTablePermission\Tables\Actions\Roles;

use Closure;
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

    protected Field|Closure|null $field = null;

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

        $this->successNotificationTitle(fn (Collection $records): string => trans_choice("$this->LANG_NAMESPACE.roles.sync.messages.synced", $records));

        $this->icon('heroicon-o-sparkles');

        $this->form(fn () => [$this->getField()])->deselectRecordsAfterCompletion();

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

    public static function getDefaultField(): Select
    {
        return Select::make('roleId')->label(__('filament-table-permission::actions.roles.sync.field.label'))
            ->options(Role::query()->pluck('name', 'id'))
            ->required();
    }

    public function getField(): Field
    {
        $field = $this->getDefaultField();

        return $this->evaluate($this->field, [
            'field' => $field,
        ]) ?: $field;
    }

    public function field(Closure|Field $field = null): SyncRolesBulkAction
    {
        $this->field = $field;

        return $this;
    }
}
