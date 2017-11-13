<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter extends MY_Controller
{

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $itemFilters = $this->input->post('itemFilters');
            $itemType = $this->input->post('itemType');
            $filterIdOrName = $this->input->post('filterIdOrName');
            $option = $this->input->post('option');
            $tagFilters = $this->input->post('tagFilters');
            if ($option == 'new') {
                $data = [
                    'ItemTypeId' => $itemType,
                    'FilterName' => $filterIdOrName,
                    'FilterSql' => 'StatusId > 0',
                    'FilterData' => $itemFilters,
                    'TagFilter' => $tagFilters,
                    'StatusId' => 2,
                    'CrUserId' => $this->session->userdata('user')['UserId'],
                    'CrDateTime' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('filters', $data);
            } else if ($option == 'exits') {
                $query = $this->db->where('FilterId', $filterIdOrName)->get('filters');
                $filter = $query->row();
                if (!empty($filter)) {
                    $this->db->where('FilterId', $filterIdOrName);
                    $this->db->update('filters', ['FilterData' => $itemFilters, 'TagFilter' => $tagFilters]);
                }
            } else {
                echo json_encode(['status' => 'er']);
                return;

            }
            echo json_encode(['status' => 'done']);
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $filterId = $this->input->post('filterId'); // 0 là tab tất cả , các tab còn lại sẽ có id tằng dần từ 1->n
            $query = $this->db->select(['FilterData', 'TagFilter'])->where('FilterId', $filterId)->get('filters');
            $filter = $query->row();
            if (!empty($filter)) {
                $this->db->delete('filters', ['FilterId' => $filterId]);
                echo json_encode(['status' => 'done']);
                return;
            }
            echo json_encode(['status' => 'er']);
        }
    }

}