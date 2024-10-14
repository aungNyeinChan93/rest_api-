<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\ContactEditResource;
use App\Http\Resources\ContactsListResource;
use App\Models\Contact;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //contact list
    public function list()
    {
        try {
            $contacts = Contact::orderBy("id", "desc")->get();
            return ResponseHelper::success(ContactsListResource::collection($contacts), "success");
        } catch (\Throwable $th) {
            return ResponseHelper::fail([], $th->getMessage());
        }
    }

    // contact create
    public function create(Request $request)
    {
        // dd($request);
        // skip validation
        try {
            $res = Contact::create([
                "user_id" => $request->user_id,
                "title" => $request->title,
                "message" => $request->message,
            ]);
            return response()->json([
                "message" => "success",
                "data" => $res,
            ]);
        } catch (\Throwable $th) {
            return ResponseHelper::fail([], $th->getMessage());
        }
    }

    // contact delete
    public function delete(Request $request)
    {
        $contact = Contact::find($request->id);
        // dd($contact);
        if (!empty($contact)) {
            $contact->delete();
            return response()->json([
                "message" => "success",
                "data" => $contact,
            ]);
        } else {
            return response()->json(["message" => "contact have not found!"]);
        }
    }

    // contact detail
    public function detail(Request $request)
    {
        $contact = Contact::findOrFail($request->id);
        if (isset($contact)) {
            return response()->json([
                "messaage" => "success",
                "data" => $contact,
            ]);
        } else {
            return response()->json([
                "message" => "fail !!!"
            ]);
        }
    }

    // edit contact
    public function edit(Request $request)
    {
        try {
            $contact = Contact::findOrFail($request->contact_id);
            if (!empty($contact)) {
                $contact->update([
                    "title" => $request->contact_title,
                    "message" => $request->contact_message,
                ]);
                return ResponseHelper::success(new ContactEditResource($contact), "success");
            }
        } catch (\Throwable $th) {
           return ResponseHelper::fail($th->getMessage());
        }
    }
}
