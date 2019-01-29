<?php

namespace App\Services;

use App\Jobs\FileJob;
use App\Models\Member;
use App\Repository\MemberRepository;
use App\Models\File;
use Illuminate\Support\Facades\Validator;

class FileJobService
{
    protected $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    /**
     * Upload file to storage
     *
     * @param File $file
     * @return void
     */
    public function addToQueue(File $file): void
    {
        FileJob::dispatch($file);
    }

    /**
     * Upload file to storage
     *
     * @param string $fileContent
     * @return array
     */
    public function addMembers(string $fileContent): array
    {
        $memberLine = 0;
        $error = '';

        $members = explode("\n", $fileContent);
        $membersCount = count($members);

        try {
            foreach ($members as $member) {
                $memberData = array_map('trim', explode("\t", $member));

                $data = [
                    'full_name' => $memberData[5],
                    'address' => $memberData[7] . ' ' . $memberData[8],
                    'city' => $memberData[9],
                    'state' => $memberData[10],
                    'zipcode' => $memberData[11],
                    'is_union' => $memberData[12] === 'Y',
                    'member_number' => $memberData[3],
                    'email' => $memberData[26],
                    'phone' => $memberData[27],
                ];

                if ($this->validateMember($data)) {
                    throw new \Exception($member);
                }

                $this->addMember($data);

                $memberLine++;
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        return ['treated_members' => $memberLine, 'members' => $membersCount, 'error' => $error];
    }

    /**
     * @param array $data
     * @return Member
     */
    protected function addMember(array $data): Member
    {
        return $this->memberRepository->save($data);
    }

    /**
     * @param array $data
     * @return bool
     */
    protected function validateMember(array $data): bool
    {
        $validator = Validator::make($data, [
            'full_name' => 'required|string',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'is_union' => 'required',
            'member_number' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        return $validator->fails();
    }
}
