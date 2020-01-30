<?php

namespace App\Traits;

trait MsiData
{
    protected function msiData($request)
    {
        try {
            $search = $request->get('search');
            $clause = $request->get('clause', $this->msiDefault('clause'));
            $column = $request->get('column', $this->msiDefault('column'));

            $relation = $request->get('relation');

            $order = $request->get('order', $this->msiDefault('order'));
            $direction = $request->get('dir', $this->msiDefault('direction'));

            $page = $request->get('page');
            $start = $request->get('start', 0);
            $limit = $request->get('limit', 10);

            $query = $this->msiClass()->name::select('*');

            // search
            if (!empty($search)) {
                $columns = $this->msiValidArray(explode(',', $column), 'msiIsColumn');
                if ($this->msiIsSetupClause($clause)) {
                    foreach ($columns as $column) {
                        if ($clause == $this->msiDefault('clause')) {
                            $query->{$clause}($column, 'like', "%$search%");
                        } else {
                            $query->{$clause}($column, explode(' ', $search));
                        }
                    }
                }
            }

            // relation
            if (!empty($relation)) {
                $relations = $this->msiValidArray(explode(',', $relation), 'msiIsMethod');
                $query->with($relations);
            }

            // order
            if (!empty($order)) {
                $orders = $this->msiValidArray(explode(',', $order), 'msiIsColumn');
                $directions = explode(',', $direction);
                foreach ($orders as $key => $column) {
                    if (count($orders) == count($directions)) {
                        if ($this->msiIsSetupDirection($directions[$key])) {
                            $dir = $directions[$key];
                        } else {
                            $dir = $this->msiDefault('direction');
                        }
                    } else {
                        $dir = $this->msiDefault('direction');
                    }
                    $query->orderBy($column, $dir);
                }
            }

            // page
            $paginate = $query->paginate($limit)->toArray();
            if (empty($page)) {
                $paginate['from'] = $start;
                $paginate['to'] = $limit + ($start - 1);
                $paginate['data'] = $query->skip($start)->take($limit)->get();
            }

            return $this->msiResponse($paginate);
        } catch (\Exception $e) {
            return $this->msiResponse(['message' => $e->getMessage()], true);
        }
    }
}
